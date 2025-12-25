<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController extends Controller
{
    function index() {
        return view('welcome');
    }

    function findUser(Request $request) {
        try {
            $authenticated = $request->validate([
            'email' => "email|required",
            'password' => "required"
            ]);
        }   catch(Exception $e) {
            return redirect()->back()->with(["failMessage" => "Vul alle gegevens in."]);
        }

        if (Auth::attempt($authenticated)) {
            return redirect()->to("/");
        }
        #Checks user existence for the correct error message

        if (User::where('email', $authenticated['email'])->exists()) 
            return redirect()->back()->with(["failMessage" => "Incorrect wachtwoord."]);
        
        return redirect()->back()->with(["failMessage" => "Account niet gevonden."]);
        
    }

    function login() {
        return view('account.login.login');
    }

    function register() {
        return view("account.login.register");
    }
}
