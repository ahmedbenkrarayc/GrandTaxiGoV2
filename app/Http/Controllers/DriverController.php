<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class DriverController extends Controller
{
    public function editAvailability(){
        return view('driver.disponibility');
    }

    public function updateAvailability(Request $request){
        $request->validate([
            'status' => 'required|string'
        ]);

        $driver = Driver::find(Auth::user()->id);
        if($driver){
            $driver->availability = $request->status;
            $driver->save();
        }else{
            Driver::create([
                'id' => Auth::user()->id,
                'availability' => $request->status,
                'latitude' => '0',
                'longitude' => '0'
            ]);
        }

        return back()->with('success', 'Updated successfully !');
    }

    public function getAllAvailable(){
        $drivers = Driver::with('user')->where('availability', 'available')->get();
        return response()->json([
            'drivers' => $drivers
        ]);
    }
}
