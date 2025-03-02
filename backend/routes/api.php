<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:login-register');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login-register');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);




Route::middleware('auth:sanctum')->group(function () {
   
    Route::get('/products', [ProductController::class, 'index']);

    
    Route::middleware('role:admin')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    });
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [HomeController::class, 'index']);
});

// Route::get('/index-product', [ProductController::class, 'index']);