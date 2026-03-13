<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('reservations.index');
});

Route::resource('reservations', ReservationController::class);
Route::patch('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
Route::get('reservations/{reservation}/print', [ReservationController::class, 'print'])->name('reservations.print');
Route::get('reservations/{reservation}/print-registration', [ReservationController::class, 'printRegistration'])->name('reservations.print-registration');