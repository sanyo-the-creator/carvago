<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('cars', CarsController::class);

//search cars
Route::get('/cars/search/{name}', [CarsController::class, 'search']);

//register
Route::post('/register', [AuthController::class, 'register']);

//login
Route::post('/login', [AuthController::class, 'login']);