<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => ['role:admin']], function () {
    // API for Movie
    Route::apiResource('movies', MovieController::class);
    // API for Rating
    Route::get('ratings/{id}', [RatingController::class, 'show']);
    Route::get('ratings', [RatingController::class, 'index']);

    // API for users
    Route::apiResource('users', UserController::class);
});

Route::group(['middleware' => ['role:user,admin']], function () {
    Route::delete('ratings/{id}', [RatingController::class, 'destroy']);
});

Route::group(['middleware' => ['role:user']], function () {
    Route::post('ratings', [RatingController::class, 'store']);
    Route::put('ratings/{id}', [RatingController::class, 'update']);
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);
});
