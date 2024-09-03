<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Borrow_RecordController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// User routes
Route::middleware(['auth:api', 'checkRole:user'])->group(function () {
    // Borrow book
    Route::post('/borrow', [Borrow_RecordController::class, 'store']);
    // Return book
    Route::put('/borrow/{id}', [Borrow_RecordController::class, 'update']);
    // Show all books
    Route::get('/books', [BookController::class, 'index']);
    // Show one book
    Route::get('/books/{book}', [BookController::class, 'show']);
    // Add, update, show rating
    Route::resource('/Ratings', RatingController::class);
});

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});



// Admin routes
Route::middleware(['auth:api', 'checkRole:admin'])->group(function () {

    Route::get('/User/{name}', [UserController::class, 'show']);
    // Add, update, show user
    Route::resource('/User', UserController::class);
    // Add, update, show book
    Route::resource('/books', BookController::class);
    // Show rating
    Route::get('/Ratings/{id}', [RatingController::class, 'show']);
    // Delete rating
    Route::delete('/Ratings/{id}', [RatingController::class, 'destroy']);
    // Delete borrow record
    Route::delete('/borrow/{date}', [Borrow_RecordController::class, 'destroy']);
    // Show borrow records
    Route::get('/borrow', [Borrow_RecordController::class, 'index']);

});
