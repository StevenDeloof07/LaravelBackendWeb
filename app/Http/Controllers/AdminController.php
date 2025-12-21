<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function isAdmin($user) {
        return !empty(DB::table('admin')->where("user_id", $user["id"])->first());
    }

    function index() {
        $user = Auth::user();

        if (empty($user)) return view("account.login");

        if ($this->isAdmin($user));

        $allUsers = User::all();
        $usersData = [];

        foreach($allUsers as $currentUser) {
            array_push($usersData, [
                'id' => $currentUser['id'],
                'name' => $currentUser['name'],
                'email' => $currentUser['email'],
                'isAdmin' => $this->isAdmin($currentUser)
            ]);
        }

        $data = [
            'name' => $user['name'], 
            'users' => $usersData
        ];

        return view("account.admin.users")->with($data);
    }
}
