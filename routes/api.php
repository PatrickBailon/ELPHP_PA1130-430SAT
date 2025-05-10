<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookmarkController;

// AUTH ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// USER ROUTES
Route::middleware(['auth:sanctum', 'role:admin'])->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->put('/users/{id}', [UserController::class, 'update']);
Route::middleware(['auth:sanctum', 'role:admin'])->delete('/users/{id}', [UserController::class, 'destroy']);

// VEHICLE ROUTES
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:owner'])->post('/vehicles', [VehicleController::class, 'store']);
Route::middleware(['auth:sanctum', 'role:owner'])->put('/vehicles/{id}', [VehicleController::class, 'update']);
Route::middleware(['auth:sanctum', 'role:owner'])->delete('/vehicles/{id}', [VehicleController::class, 'destroy']);

// BOOKING ROUTES
Route::middleware(['auth:sanctum', 'role:admin'])->get('/bookings', [BookingController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:renter'])->post('/bookings', [BookingController::class, 'store']);
Route::middleware(['auth:sanctum', 'role:owner'])->put('/bookings/{id}', [BookingController::class, 'update']);
Route::middleware(['auth:sanctum', 'role:renter'])->delete('/bookings/{id}', [BookingController::class, 'destroy']);

// REVIEW ROUTES
Route::get('/reviews', [ReviewController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:renter'])->post('/reviews', [ReviewController::class, 'store']);
Route::middleware(['auth:sanctum', 'role:renter'])->put('/reviews/{id}', [ReviewController::class, 'update']);
Route::middleware(['auth:sanctum', 'role:renter'])->delete('/reviews/{id}', [ReviewController::class, 'destroy']);

// BOOKMARK ROUTES
Route::get('/bookmarks', [BookmarkController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:renter'])->post('/bookmarks', [BookmarkController::class, 'store']);
Route::middleware(['auth:sanctum', 'role:renter'])->delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']);