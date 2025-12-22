<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

        $id = $request['user_id'];


        if (empty(User::where("id", $id)->first())) 
            return redirect()->back()->with(["error" => "Deze gebruiker bestaat niet"]);

        if (!empty(Admin::where("user_id", $id)->first()))
            return redirect()->back()->with(['error' => "Deze gebruiker lijkt al een admin te zijn"]);

        Admin::create([
            "user_id" => $id
        ]);


        return redirect()->back()->with(["message" => "Gebruiker is nu een admin"]);
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
