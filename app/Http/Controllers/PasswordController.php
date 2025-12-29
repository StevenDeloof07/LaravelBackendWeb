<?php

namespace App\Http\Controllers;

use App\Mail\SendResetRequest;
use App\Models\passwordResetToken;
use App\Models\User;
use App\validateRequest;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;

class PasswordController extends Controller
{
    use validateRequest;
    function changeView() {
        return view('account.login.reset');
    }

    function changeRequest(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'user_mail' => "required|email|exists:users,email"
            ]);
        }
        catch (Exception $e) {
            return redirect()->back()->with("error", "Er is geen account gekoppeld aan deze mail");
        }

        $token = Str::random(64);

        $encryptedToken = hash_hmac('sha256', $token, config('app.key'));


        DB::table('password_reset_tokens')->updateOrInsert(
            [ 'email' => $validated['user_mail']],
            [
                'token' => $encryptedToken,
                'created_at' => now()
            ]
        );

        $url = route('change_pass_view', $token) . '?email=' . urlencode($validated['user_mail']);


        $user = User::where('email', '=', $validated['user_mail'])->first();

        $data['url'] = $url;
        $data['name'] = $user['name'];
        $data['email'] = $user['email'];


        Mail::to($data['email'])->send(new SendResetRequest($data));
        return redirect()->back()->with('message', "Verzoek succesvol doorgestuurd! Vergeet de mails niet te checken.");
    }

    function updateView(string $token, Request $request) {
        $email = (string) $request->query('email', 'none');
        $data = [
            'email' => $email,
            'token' => $token
        ];

        return view('account.login.newpass', $data);
    }

    function change(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'mail' => 'required|email',
                'token' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        $token = hash_hmac(('sha256'), $validated['token'], config('app.key'));


        $row = passwordResetToken::where(['email' => $validated, 'token' => $token ])->first();


        if (empty($row) || now()->diffInMinutes($row->created_at) < -60) {
            return redirect()->to(route('login'))->
            with('error', "Vervangingsverzoek is vervallen, stuur een nieuw verzoek om het wachtwoord aan te passen");
        }

        $user = User::where(['email' => $validated['mail']])->first();

        if (empty($user)) {
            return redirect()->to(route('login'))->
            with('error', "Vervangingsverzoek is vervallen, stuur een nieuw verzoek om het wachtwoord aan te passen");
        }        

        $user->update(['password' => Hash::make($validated['password'])]);

        passwordResetToken::where(['email' => $validated])->delete();

        Auth::login($user);

        return redirect()->to(route('home'))->with('message', "Wachtwoord succesvol aangepast");
    }
}
