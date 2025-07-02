<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CountryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Register User
Route::post('/register', [RegistrationController::class,'store']);

// Return Countries
Route::get('/countries', [CountryController::class,'index']);
