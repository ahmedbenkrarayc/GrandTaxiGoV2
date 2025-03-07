<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Driver;

class ReservationController extends Controller
{
    public function create($driverid){
        $driver = Driver::with('user')->findOrFail($driverid);
        return view('home', compact('driver'));
    }
}
