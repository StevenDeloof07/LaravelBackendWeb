<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function index() {
        $user = Auth::user();

        $allUsers = User::where('id', "!=", $user->id)->get();
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
            'id' => $user['id'],
            'name' => $user['name'], 
            'users' => $usersData,
            'isAdmin' => true
        ];

        

        return view("account.admin.users")->with($data);
    }

    function createAdmin(Request $request) {

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

    function createUser(Request $request) {
        try {
            $validated = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "birthday" => "required|date",
            "about_me" => "nullable|string",
            "password" => "required|min:8|confirmed",
            "isAdmin" => "string|max:2"
            ]);
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with(["error", $e]);
        }



        $user = User::create([
            "name" => $validated['name'],
            "email" => $validated['email'],
            "birthday" => $validated['birthday'],
            "about_me" => $validated['about_me'],
            "password" => Hash::make($validated['password'])
        ]);

        if (isset($validated['isAdmin'])) {
            Admin::create(["user_id" => $user['id']]);
        }

        return redirect()->back()->with(["message", "Gebruiker succesvol aangemaakt"]);
    }

    function remove(Request $request, $id) {

        if (empty(User::where("id", $id)->first())) 
            return redirect()->back()->with(["error" => "Deze gebruiker bestaat niet"]);

        $admin = Admin::where("user_id", $id)->first();

        if (empty($admin))
            return redirect()->back()->with(['error' => "Deze gebruiker lijkt geen admin te zijn"]);

        $admin->delete();
        return redirect()->back()->with(["message" => "De adminrechten van de gebruiker zijn succesvol verwijdert"]);
    }

}
