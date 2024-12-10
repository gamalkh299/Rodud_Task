<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//login
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'signin'])->name('login');
    Route::post('register', [AuthController::class, 'register']);


});
