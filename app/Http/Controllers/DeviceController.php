<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use App\validateRequest;
use DB;
use Exception;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    use validateRequest;
    function index() {
        $devices = Device::get();
        return view('users.devices', ['devices' => $devices]);
    }

    function getManagement() {
        $devices = Device::get();
        return view('account.admin.devices', ['devices' => $devices]);
    }

    function create(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'name' => 'required|string',
                'description' => "required|string",
                'release_date' => "required",
                'picture' => "required|image|mimes:jpeg,png,jpg"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        $path = $validated['picture']->store("images/devices", "public");

        $data = [
            'name' => $validated['name'],
            'release_date' => $validated['release_date'],
            'description' => $validated['description'],
            'picture_link' => $path
        ];
        
        Device::create($data);

        return redirect()->back();
    }

    function remove(Request $request) {
        try {
            $validated = $request->validate(['id' => "required|exists:devices,id"]);
        } catch (Exception $e) {
           return redirect()->back()->with('error', 'dit apparaat lijkt niet meer te bestaan, contacteer de beheerder van de site');
        }
        Device::where('id', "=", $validated['id'])->delete();   

        return redirect()->back();
    }

    function makeFavorite(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'device_id' => 'required|exists:devices,id',
                'user_id' => 'required|exists:users,id' 
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Er is iets fout gegaan, probeer later opnieuw.");
        }

        $user = User::find($validated['user_id']);
        $user->devices()->attach($validated['device_id']);

        return redirect()->back();
    }

    function removeFavorite(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'device_id' => 'required|exists:devices,id',
                'user_id' => 'required|exists:users,id' 
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Er is iets fout gegaan, probeer later opnieuw.");
        }
        $user = User::find($validated['user_id']);
        $user->devices()->detach($validated['device_id']);
        return redirect()->back();
    }
}
