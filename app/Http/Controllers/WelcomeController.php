<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function index() {
        if (empty(Auth::user() )) return view("account.login");
        return view('welcome');
    }

    function findUser(Request $request) {
        $authenticated = $request->validate([
            'email' => "email|required",
            'password' => "required"
        ]);

        if (Auth::attempt($authenticated)) {
            redirect()->to(route("home"));
        }
    }

    function register() {
        return view("account.register");
    }
}
