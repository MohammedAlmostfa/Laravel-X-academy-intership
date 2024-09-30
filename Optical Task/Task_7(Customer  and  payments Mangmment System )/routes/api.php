<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PymentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('customer', CustomerController::class);

Route::resource('payments', PymentsController::class);

Route::post('customers/{id}/latest-payment', [PymentsController::class,'lastpayment']);
Route::post('customers/{id}/oldest-payment', [PymentsController::class,'oldestpayment']);
Route::post('customers/{id}/lowest-payment', [PymentsController::class,'lowestpayment']);
Route::post('customers/{id}/hightest-payment', [PymentsController::class,'hightestpayment']);
Route::post('customers/{id}', [PymentsController::class,'customer_pyment']);
