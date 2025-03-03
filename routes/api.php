<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Define routes for registration and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes for user update, delete, and logout
Route::middleware('auth:sanctum')->group(function () {
    // Route::put('/user/update', [AuthController::class, 'update']);  // Update user info
    // Route::delete('/user/delete', [AuthController::class, 'destroy']);  // Delete user
    Route::post('/logout', [AuthController::class, 'logout']);  // Logout user

});
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/{id}/update', [AuthController::class, 'update']);  // Update user info by ID
    Route::delete('/user/{id}/delete', [AuthController::class, 'destroy']);  // Delete user by ID
});


Route::put('/user/{id}', [AuthController::class, 'update']);  // Update user by ID
Route::delete('/user/{id}', [AuthController::class, 'destroy']);  // Delete user by ID

use App\Http\Controllers\ProductController;

// Define API routes for products
Route::get('/products', [ProductController::class, 'index']); // Get all products
Route::post('/products', [ProductController::class, 'store']); // Create a new product
Route::get('/products/{id}', [ProductController::class, 'show']); // Get a specific product
Route::put('/products/{id}', [ProductController::class, 'update']); // Update a product
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Delete a product