<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\Trajet;

class ReservationController extends Controller
{
    public function create($driverid){
        $driver = Driver::with('user')->findOrFail($driverid);
        return view('reservation.create', compact('driver'));
    }

    public function store(Request $request){
        $reservation = Reservation::create([
            'driver_id' => $request->driver_id,
            'passenger_id' => $request->passenger_id,
        ]);

        $trajet = Trajet::create([
            'startDateTime' => $request->startDateTime,
            'startPlace' => $request->startPlace,
            'destination' => $request->destination,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'reservation_id' => $reservation->id,
        ]);

        return redirect('/passenger/history');
    }
}
