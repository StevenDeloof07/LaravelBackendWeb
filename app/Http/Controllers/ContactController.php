<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Mail\sendResponse;
use App\Models\Admin;
use App\Models\Form;
use App\Models\User;
use App\validateRequest;
use Exception;
use Illuminate\Http\Request;
use Mail;
use function PHPUnit\Framework\returnArgument;

class ContactController extends Controller
{
    use validateRequest;
    function index() {
        return view('users.contact');
    }
    
    function contact(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'user_email' => 'required|email',
                "question" => 'required|string'
            ], "Gelieve alles correct in te vullen, en liefst niet te knoeien met de javascript :)");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $admins = [];

        foreach (Admin::get() as $admin) {
            array_push($admins, User::where('id', '=', $admin['user_id'])->get()->first());
        }


        foreach($admins as $admin) {
            $data = $validated;
            $data['admin'] = $admin['name'];
            Mail::to($admin['email'])->send(new OrderShipped($data));
        }


        Form::create($validated);

        return redirect()->back()->with("succes", "vraag succesvol doorgestuurd");

    }

    function get() {
        return view('account.admin.contactForm', ["forms" => Form::get()]);
    }

    function respond(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'id' => 'required|exists:forms,id',
                'anwser' => 'required|string'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $questionForm = Form::where('id', '=', $validated['id'])->first();


        $current = auth()->user();

        $data = [
            'question' => $questionForm['question'],
            'sender' => $current['name'],
            'sender_mail' => $current['email'],
            'anwser' => $validated['anwser']
        ];


        Mail::to($questionForm['user_email'])->send(new sendResponse($data));

        Form::where('id', '=', $validated['id'])->update(['anwsered' => true]);
        return redirect()->back();
    }
}
