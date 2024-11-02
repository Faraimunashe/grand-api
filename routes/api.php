<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\HistoryController;
use App\Http\Controllers\Api\V1\DashboardController;


Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');


    Route::group(['middleware' => ['auth:sanctum']], function () {
        //logout
        Route::post('/logout', [AuthController::class, 'logout']);

        //profile
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/history', [HistoryController::class, 'index']);
        Route::post('/physiotherapy', [HistoryController::class, 'store']);
        Route::get('/dashboard', [DashboardController::class, 'index']);

    });
});
