<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');;
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');;

Route::get('services/all', [ServiceController::class, 'all'])->name('services.all');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('appointments', AppointmentController::class)->except(['update']);
});



