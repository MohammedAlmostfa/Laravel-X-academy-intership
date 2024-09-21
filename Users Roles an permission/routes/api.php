<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\RoleController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});


Route::middleware(['checkRole'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::post('users/{user}/role/{role}', [UserController::class, 'addRole']);
    Route::delete('users/{user}/role/{role}', [UserController::class, 'deleteRole']);
    Route::post('role/{role}/permission/{permission}', [RoleController::class, 'addPermission']);
    Route::delete('role/{role}/permission/{permission}', [RoleController::class, 'deletePermission']);
});
