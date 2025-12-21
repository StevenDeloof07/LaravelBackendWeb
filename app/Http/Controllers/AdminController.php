<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        $user = Auth::user();

        if (empty($user)) return view("account.login");



        if (DB::table('admin')->where("user_id", $user["id"])) 
            return view("account.admin.users");
        return redirect()->to(route("home"));
    }
}
