<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Exception;
use Hash;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class AccountController extends Controller
{
    function index($id) {
        $user = User::where('id', $id)->first();
        if (empty($user)) return redirect()->back();

        $data = $user;

        $devices = [];

        $userDevices = $data->devices;
        foreach ($userDevices as $device) {
            array_push($devices, [
                'name' => $device['name'],
                'picture_link' => $device['picture_link']
            ]);
        }

        if (!empty($devices))  $data['devices'] = $devices;


        return view('account.profile.about')->with("data", $data);
    }

    function store(Request $request) {
        //https://kritimyantra.com/blogs/laravel-12-upload-images
        //Used for saving images
        try {
            $validated = $request->validate([
                "name" => "required",
                "email" => "required|email|unique:users",
                "birthday" => "required",
                "about_me" => "required",
                "password" => "required|min:8|confirmed",
                "profile_picture" => "nullable|image|mimes:jpeg,png,jpg" 
            ]);
        }   catch (Exception $e) {
            redirect()->back()->with("message", "Niet alle waarden zijn correct ingevuld");
        }
        $path = "images/user/paint.png";

        if ($request["profile_picture"] != null) {
            $path = $request->file("profile_picture")->store("images/user", "public");
        }

        $remembered = false;
        if ($request['remember_me'] != null) $remembered = true;

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "birthday" => $request->birthday,
            "about_me" => $request->about_me,
            "password" => Hash::make($request->password),
            "picture_link" => $path
        ]);

        Auth::login($user, $remembered);

        return redirect()->to("/");
    }

    function changeInfo($id, Request $request) {
        try {
            $validated = $request->validate([
                "name" => "required|string",
                "about_me" => "required|string",
                "birthday" => "required"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Niet alle waarden zijn correct ingevuld");
        }

        $user = User::get()->where('id' ,  $id)->first();

        $user->update([
            "name" => $validated['name'],
            "about_me" => $validated['about_me'],
            "birthday" => $validated['birthday']
        ]);
        return redirect()->back()->with("message", "Account succesvol aangepast!");
    }

    function logout(Request $request) {
        #regeneration of csrf token and invalidation from session suggested by https://laravel.com/docs/12.x/authentication
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route("home"));
    }
}
