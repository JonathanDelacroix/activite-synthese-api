<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ShoppingListController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;


RateLimiter::for('auth', function (Request $request) {
    return Limit::perMinute(8)
        ->by($request->ip());
});

/* Auth routes */
Route::middleware('throttle:auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});

/* Protected routes */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/lists/me', [ShoppingListController::class, 'show']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
    Route::put('/items/{item}', [ItemController::class, 'update']);
    Route::delete('/items/{item}', [ItemController::class, 'destroy']);
});