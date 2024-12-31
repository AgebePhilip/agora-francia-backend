<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/shippings', [OrderDetailController::class, 'store']);

Route::post('/contacts', [ContactController::class, 'store']);


Route::prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'store']); // Create product
    Route::get('/', [ProductController::class, 'index']); // Get all products
    Route::get('{id}', [ProductController::class, 'show']); // Get product by ID
    Route::put('{id}', [ProductController::class, 'update']); // Update product
    Route::delete('{id}', [ProductController::class, 'destroy']); // Delete product
    //public routes
    
});



// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'show']);

    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::post('/admin/sellers', [AdminController::class, 'addSeller']);
        Route::delete('/admin/sellers/{seller}', [AdminController::class, 'removeSeller']);
        // Additional admin routes can be added here
    });

    // Seller Routes
    Route::middleware('role:seller,admin')->group(function () {
        Route::post('/items', [ItemController::class, 'store']);
        Route::put('/items/{item}', [ItemController::class, 'update']);
        Route::delete('/items/{item}', [ItemController::class, 'destroy']);
    });

    // Buyer Routes
    Route::middleware('role:buyer,admin')->group(function () {
        Route::post('/items/{item}/bid', [BidController::class, 'placeBid']);
        Route::post('/items/{item}/purchase', [TransactionController::class, 'purchase']);
    });

    //categories route
    Route::middleware('auth:sanctum')->group(function () {
        // Admin Routes
        Route::middleware('role:admin')->group(function () {
            Route::post('/category', [CategoryController::class, 'store']);
            Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
        });

    });

    // General Item Routes
    Route::get('/all/items', [ItemController::class, 'index']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
});
