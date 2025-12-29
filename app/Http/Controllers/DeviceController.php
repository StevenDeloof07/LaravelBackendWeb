<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\validateRequest;
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
}
