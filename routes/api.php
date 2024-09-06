<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('profile/{id}', [UserController::class, 'show']);
Route::patch('profile/{id}', [UserController::class, 'update']);
Route::post('product', [ProductController::class, 'newProduct']);
Route::post('purchase/{id}', [ProductController::class, 'newPurchase']);
