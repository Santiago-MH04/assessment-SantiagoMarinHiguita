<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

    //User-related endpoints
Route::get('/users/apps/{userID}', [UserController::class, 'showAppointments'])->name('user.appointments');
Route::get('/users/apps/book/{userID}', [UserController::class, 'bookAppointmentForm'])->name('user.appointments');
Route::post('/users/apps/book', [UserController::class, 'bookAppointment'])->name('user.appointments.book');
Route::post('/users/apps/cancel/{appointmentID}', [UserController::class, 'cancelAppointment'])->name('user.appointments.cancel');

    //Physician-related endpoints
Route::get('/meds/apps/{physicianID}', [PhysicianController::class, 'showAppointments'])->name('physician.appointments');
Route::get('/meds/apps/{physicianID}', [PhysicianController::class, 'showAppointments'])->name('physician.appointments');
Route::put('/meds/apps/{appointmentID}', [PhysicianController::class, 'updateAppointment'])->name('physician.appointments.update');
Route::put('/meds/apps/{userID}', [PhysicianController::class, 'updateComorbidities'])->name('pacient.comorbidities.update');

Route::get('/users/apps/book/{userID}', [UserController::class, 'bookAppointmentForm'])->name('user.appointments');
Route::post('/users/apps/book', [UserController::class, 'bookAppointment'])->name('user.appointments.book');
Route::post('/users/apps/cancel/{appointmentID}', [UserController::class, 'cancelAppointment'])->name('user.appointments.cancel');


