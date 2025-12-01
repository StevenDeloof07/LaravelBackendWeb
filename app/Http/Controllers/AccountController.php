<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    function store(Request $request) {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed"
        ]);


        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        Auth::login($user);

        redirect()->to("/");
    }

    function logout(Request $request) {
        #regeneration of csrf token and invalidation from session suggested by https://laravel.com/docs/12.x/authentication
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route("home"));
    }
}
