<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('home');
});

Route::get('/driver/status', [DriverController::class, 'editAvailability']);
Route::put('/driver/updateAvailability', [DriverController::class, 'updateAvailability']);

Route::get('/driver/history', [HistoryController::class, 'driverHistory']);
Route::get('/driver/reservation/accept/{id}', [HistoryController::class, 'acceptReservation']);
Route::get('/driver/reservation/reject/{id}', [HistoryController::class, 'rejectReservation']);


Route::get('/passenger/history', [HistoryController::class, 'passengerHistory']);
Route::get('/reservation/cancel/{id}', [HistoryController::class, 'cancelReservation']);
Route::get('/reservation/details/{id}', [HistoryController::class, 'findReservation']);

Route::get('/driver/location/{id}', [LocationController::class, 'getDriverLocation']);
Route::post('/driver/location', [LocationController::class, 'updateDriverLocation']);

Route::get('/drivers', [DriverController::class, 'getAllAvailable']);

// Route::get('/passenger/reservations', function () {
//     return view('passenger.reservations');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
