<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Reservation;
use App\Models\Rating;

class RateController extends Controller
{
    public function passengerRate($id){
        $reservation = Reservation::with('driver.user', 'passenger', 'trajet')->findOrFail($id);
        return view('passenger.review', compact('reservation'));
    }

    public function addPassengerRate(Request $request){
        Rating::create([
            'rate' => $request->rating,
            'comment' => $request->comment,
            'writer_role' => 'passenger',
            'reservation_id'=> $request->id
        ]);

        return redirect('/passenger/history');
    }

    public function driverRate($id){
        $reservation = Reservation::with('driver.user', 'passenger', 'trajet')->findOrFail($id);
        return view('driver.review', compact('reservation'));
    }

    public function addDriverRate(Request $request){
        Rating::create([
            'rate' => $request->rating,
            'comment' => $request->comment,
            'writer_role' => 'driver',
            'reservation_id'=> $request->id
        ]);

        return redirect('/driver/history');
    }

    public function driverReviews(){
        $reservations = Reservation::with('ratings', 'passenger')
        ->where('driver_id', Auth::user()->id)
        ->whereHas('ratings', function($query){
            $query->where('writer_role', 'passenger');
        })
        ->get();

        return view('driver.ratings', compact('reservations'));
    }

    public function passengerReviews(){
        $reservations = Reservation::with('ratings', 'driver.user')
        ->where('passenger_id', Auth::user()->id)
        ->whereHas('ratings', function($query){
            $query->where('writer_role', 'driver');
        })
        ->get();

        return view('passenger.ratings', compact('reservations'));
    }
}
