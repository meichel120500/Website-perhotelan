<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// ===== AUTH ROUTES =====
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ===== PROTECTED ROUTES =====
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('reservations.index');
    });

    Route::resource('reservations', ReservationController::class);

    Route::patch('reservations/{reservation}/status',
        [ReservationController::class, 'updateStatus']
    )->name('reservations.status');

    Route::get('reservations/{reservation}/print',
        [ReservationController::class, 'print']
    )->name('reservations.print');

    Route::get('reservations/{reservation}/print-registration',
        [ReservationController::class, 'printRegistration']
    )->name('reservations.print-registration');
});
