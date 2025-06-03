<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\DashboardController;

//google auth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

//data
Route::get('/drivers', [DriverController::class, 'getAllAvailable']);
//end data

//passenger
Route::middleware(['auth', 'role:passenger'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('payment.checkout');
    Route::get('/success', [StripeController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('payment.cancel');

    Route::get('/reservation/create/{driverid}', [ReservationController::class, 'create']);
    Route::post('/reservation/create', [ReservationController::class, 'store']);
    Route::get('/passenger/history', [HistoryController::class, 'passengerHistory']);
    Route::get('/reservation/cancel/{id}', [HistoryController::class, 'cancelReservation']);
    Route::get('/reservation/details/{id}', [HistoryController::class, 'findReservation']);

    Route::get('/passenger/rate/{id}', [RateController::class, 'passengerRate']);
    Route::post('/passenger/rate', [RateController::class, 'addPassengerRate']);
    Route::get('/passenger/ratings', [RateController::class, 'passengerReviews']);
});
//end passenger

//driver
Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('/driver/status', [DriverController::class, 'editAvailability']);
    Route::put('/driver/updateAvailability', [DriverController::class, 'updateAvailability']);

    Route::get('/driver/history', [HistoryController::class, 'driverHistory']);
    Route::post('/driver/reservation/accept/{id}', [HistoryController::class, 'acceptReservation']);
    Route::get('/driver/reservation/reject/{id}', [HistoryController::class, 'rejectReservation']);
    Route::get('/driver/reservation/finish/{id}', [HistoryController::class, 'finishReservation']);

    Route::get('/driver/rate/{id}', [RateController::class, 'driverRate']);
    Route::post('/driver/rate', [RateController::class, 'addDriverRate']);
    Route::get('/driver/ratings', [RateController::class, 'driverReviews']);
});
//end driver

Route::get('/driver/location/{id}', [LocationController::class, 'getDriverLocation']);
Route::post('/driver/location', [LocationController::class, 'updateDriverLocation']);

//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/dashboard/drivers', [DashboardController::class, 'drivers']);
    Route::get('/admin/dashboard/passengers', [DashboardController::class, 'passengers']);
    Route::post('/user/delete/{id}', [DashboardController::class, 'deleteUser']);
});
//endadmin

Route::get('/dashboard', function () {
    if(Auth::user()->hasRole('passenger')){
        return redirect('/');
    }else if(Auth::user()->hasRole('driver')){
        return redirect('/driver/history');
    }else{
        return redirect('/admin/dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
