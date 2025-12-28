<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Admin;
use App\Models\User;
use App\validateRequest;
use Exception;
use Illuminate\Http\Request;
use Mail;
use function PHPUnit\Framework\returnArgument;

class ContactController extends Controller
{
    use validateRequest;
    function index() {
        return view('users.contact');
    }
    
    function contact(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'mail' => 'required|email',
                "question" => 'required|string'
            ], "Gelieve alles correct in te vullen, en liefst niet te knoeien met de javascript :)");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $admins = [];

        foreach (Admin::get() as $admin) {
            array_push($admins, User::where('id', '=', $admin['user_id'])->get()->first());
        }


        foreach($admins as $admin) {
            $data = $validated;
            $data['admin'] = $admin['name'];
            Mail::to($admin['email'])->send(new OrderShipped($data));
        }

        return redirect()->back()->with("succes", "vraag succesvol doorgestuurd");

    }
}
