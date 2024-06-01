<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//cars
Route::get('/cars', [CarsController::class, 'index']);

//add listing
Route::post('/cars', [CarsController::class, 'store'])->middleware('auth:sanctum');

//update listing
Route::put('/cars/{car}/edit', [CarsController::class, 'update'])->middleware('auth:sanctum');

//search cars
Route::get('/cars/search/{name}', [CarsController::class, 'search'])->middleware('auth:sanctum');

//register
Route::post('/register', [AuthController::class, 'register']);
