<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

// Display login page
Route::get('/', function () {
    return view('auth.login'); // Ensure this view exists
})->name('login'); // Name for the login route

// Define route for registration (GET for form)
Route::get('/register', function () {
    return view('auth.register'); // Ensure this view exists
})->name('register'); // Name for the register route

// Define routes for login and registration
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // Name for POST request
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Define protected routes for user update, delete, and logout
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/update', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/user/delete', [AuthController::class, 'destroy'])->name('user.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard'); // Ensure this view exists
})->name('dashboard')->middleware('auth'); // Protect with auth middleware

// User Management Routes
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::get('/management', [UserController::class, 'management'])->name('user.management');
});

// Product Management Routes
Route::prefix('product')->middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index'); // List products
    Route::get('/create', [ProductController::class, 'create'])->name('product.create'); // Create product form
    Route::post('/store', [ProductController::class, 'store'])->name('product.store'); // Store product
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show'); // Show product details
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit'); // Edit product form
    Route::put('/{id}', [ProductController::class, 'update'])->name('product.update'); // Update product
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('product.destroy'); // Delete product
});

// Product Category Routes
Route::get('/products/hats', [ProductController::class, 'showHats'])->name('products.hats');
Route::get('/products/tshirts', [ProductController::class, 'showTshirts'])->name('products.tshirts');
Route::get('/products/electronics', [ProductController::class, 'showElectronics'])->name('products.electronics');
Route::get('/products/cosmetics', [ProductController::class, 'showCosmetics'])->name('products.cosmetics');

// Purchase Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index'); // List purchases
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/hats', [ProductController::class, 'hats'])->name('products.hats');
Route::get('/products/tshirts', [ProductController::class, 'tshirts'])->name('products.tshirts');
Route::get('/products/electronics', [ProductController::class, 'electronics'])->name('products.electronics');
Route::get('/products/cosmetics', [ProductController::class, 'cosmetics'])->name('products.cosmetics');

// Resource routes for CRUD operations
Route::resource('purchases', PurchaseController::class);
Route::resource('products', ProductController::class);
// In web.php (routes file)
Route::post('/products/{id}/purchase', [ProductController::class, 'confirmPurchase'])->name('products.purchase');
// Define route for the payment form
Route::get('/products/{id}/payment', [ProductController::class, 'paymentForm'])->name('products.payment');
// Define route for the payment form (GET request)
Route::get('/products/{id}/payment', [ProductController::class, 'paymentForm'])->name('products.payment');
// Define route for processing payment (POST request)
Route::post('/products/{id}/payment', [ProductController::class, 'processPayment'])->name('products.processPayment');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/payment-history', [ProductController::class, 'paymentHistory'])->name('payments.history');
