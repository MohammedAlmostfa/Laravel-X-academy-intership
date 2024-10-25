<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', function () {
    return view('auth');
});


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/welcome', function () {
    return view('welcome'); // Ensure this view exists
})->name('welcome');

Route::get('/view', function () {
    return view('view');
})->name('view');


;
