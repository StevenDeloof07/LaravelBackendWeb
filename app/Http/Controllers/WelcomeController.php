<?php

namespace App\Http\Controllers;

use App\getNews;
use App\Models\News;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController extends Controller
{
    use getNews;
    function index() {
        $newsList = $this->get_all_news();

        return view('users.welcome', ["newsList" => $newsList]);
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

        //code changed using https://gemini.google.com/share/2ed45321701b
        if (Auth::attempt($authenticated, $request->has('remember_me'))) {
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
