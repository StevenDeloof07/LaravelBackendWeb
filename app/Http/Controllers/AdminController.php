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
        if (!$this->checkUser()) return redirect()->back();

        $allUsers = User::all();
        $usersData = [];

        foreach($allUsers as $currentUser) {
            array_push($usersData, [
                'id' => $currentUser['id'],
                'name' => $currentUser['name'],
                'email' => $currentUser['email'],
                'isAdmin' => $currentUser->isAdmin()
            ]);
        }


        $data = [
            'name' => $user['name'], 
            'users' => $usersData,
            'isAdmin' => true
        ];

        

        return view("account.admin.users")->with($data);
    }

    function create(Request $request) {
        if (!$this->checkUser()) return redirect()->back();

        dd($request['user_id']);
    }

    function remove(Request $request, $id) {
        if (!$this->checkUser()) return redirect()->back();

        dd($id);
    }

    function checkUser() {
        $user = Auth::user();
        return ($this->isAdmin($user));
    }
}
