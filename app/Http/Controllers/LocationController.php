<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class LocationController extends Controller
{
    public function updateDriverLocation(Request $request){
        $driver = Driver::find(Auth::user()->id);
        $driver->longitude = $request->longitude;
        $driver->latitude = $request->latitude;
        $driver->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function getDriverLocation(Request $request, $id){
        $driver = Driver::find($id);

        return response()->json([
            'longitude' => $driver->longitude,
            'latitude' => $driver->latitude
        ]);
    }
}
