<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Driver;
use Carbon\Carbon;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Mail;

class HistoryController extends Controller
{
    public function driverHistory(){
        return view('driver.history');
    }

    public function acceptReservation(Request $request, $id){
        $reservation = $this->updateStatus($id, 'accepted');
        $reservation->price = $request->price;
        $reservation->save();
        $driver = Driver::find($reservation->driver_id);
        $driver->availability = 'busy';
        $driver->save();
        Mail::to($reservation->passenger->email)->send(new ReservationMail($id, 'accepted'));
        return back()->with('success', 'Reservation accepted successfully !');
    }

    public function finishReservation(Request $request, $id){
        $reservation = $this->updateStatus($id, 'finished');
        $driver = Driver::find($reservation->driver_id);
        $driver->availability = 'available';
        $driver->save();
        return back()->with('success', 'Reservation finished successfully !');
    }

    public function rejectReservation(Request $request, $id){
        $reservation = $this->updateStatus($id, 'rejected');
        Mail::to($reservation->passenger->email)->send(new ReservationMail($id, 'rejected'));
        return back()->with('success', 'Reservation rejected successfully !');
    }

    public function cancelReservation(Request $request, $id){
        $this->updateStatus($id, 'canceled');
        $createdAt = Carbon::parse($reservation->created_at);
        if ($createdAt->diffInMinutes(Carbon::now()) <= 60) {
            $this->updateStatus($id, 'canceled');
            return back()->with('success', 'Reservation canceled successfully!');
        } else {
            return back()->with('error', 'Reservations older than 1 hour cannot be canceled.');
        }
    }

    private function updateStatus($id, $status){
        $reservation = Reservation::with('passenger')->find($id);
        if($reservation){
            $reservation->status = $status;
            $reservation->save();
            return $reservation;
        }

        return null;
    }

    public function passengerHistory(){
        return view('passenger.reservations');
    }

    public function findReservation(Request $request, $id){
        $reservation = Reservation::with('trajet', 'driver')->where('id', $id)->first();
        if(!$reservation)
            abort(404);
        return view('passenger.details', compact('reservation'));
    }
}
