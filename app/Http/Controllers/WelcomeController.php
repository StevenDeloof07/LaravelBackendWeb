<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController extends Controller
{
    function index() {
        $user = Auth::user();
        if (empty($user)) return view("account.login");
        return view('welcome')->with(['isAdmin' => $user->isAdmin()]);
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

    function register() {
        return view("account.register");
    }
}
