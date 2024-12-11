<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Order\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//login
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'signin'])->name('login');
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

});
    Route::group(['prefix' => 'orders', 'middleware' => 'auth:api'], function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/create', [OrderController::class, 'store']);
        Route::get('/order/{order}', [OrderController::class, 'show']);
        Route::put('/{order}', [OrderController::class, 'update']);
        Route::delete('/{order}', [OrderController::class, 'destroy']);
    });
