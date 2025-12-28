<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    function changeView() {
        return view('account.login.reset');
    }
}
