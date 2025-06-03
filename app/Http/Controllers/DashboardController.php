<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Driver;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $trips = Reservation::where('status', 'finished')->count();
        $canceled = Reservation::where('status', 'canceled')->count();
        $active = Driver::where('availability', 'available')->count();
        $revenue = Reservation::where('is_paid', 1)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('price');

        $reservations = Reservation::with('driver.user','passenger','trajet')->get();

        return view('admin.dashboard', compact('trips', 'canceled', 'active', 'revenue', 'reservations'));
    }

    public function drivers(){
        $drivers = Driver::with('user')->get();
        return view('admin.drivers', compact('drivers'));
    }

    public function passengers(){
        $passengers = User::whereDoesntHave('driver')->get();
        return view('admin.passengers', compact('passengers'));
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/dashboard');
    }
}
