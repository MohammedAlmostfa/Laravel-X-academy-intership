<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

// for all user
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});

//routs for admins

Route::group(['middleware' => ['role:admin']], function () {
    Route::post('User', [UserController::class, 'store']);
    Route::delete('User/{id}', [UserController::class, 'destroy']);
    Route::put('User/{id}', [UserController::class, 'update']);
    Route::get('User/{id}', [UserController::class, 'show']);
    Route::post('returnuser/{id}', [UserController::class, 'returnuser']);
});

//routs for admins and mangers
Route::group(['middleware' => ['role:admin,Manger']], function () {
    Route::post('Task/{id}/assign/{assign}', [TaskController::class, 'assign']);
    Route::post('returntask/{id}', [TaskController::class, 'returntask']);

    Route::delete('Task/{id}', [TaskController::class, 'destroy']);
    Route::post('Task', [TaskController::class, 'store']);
    Route::get('User', [UserController::class, 'index']);

});
//routs for adminsand mangers user
Route::group(['middleware' => ['role:admin,manager,user']], function () {
    Route::put('Task/{id}', [TaskController::class, 'update']);
    Route::get('Task/{id}', [TaskController::class, 'show']);
    Route::get('Task', [TaskController::class, 'index']);


});
