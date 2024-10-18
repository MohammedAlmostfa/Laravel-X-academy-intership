<?php

use App\Http\Controllers\AttachmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileUploadController;
use App\Models\Attachment;

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
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::apiResource('user', UserController::class);

Route::apiResource('task', TaskController::class);


// Middleware to check if the user is assigned to the task
Route::middleware(CheckUserRole::class)->group(function () {
    Route::put('/tasks/{taskid}/status', [TaskController::class, 'updateStatus']);
    Route::post('/tasks/{taskid}/comments/{id}', [CommentController::class,'return']);
    Route::apiResource('/tasks/{taskid}/comments', CommentController::class);


});



Route::apiResource('/tasks/{taskId}/attachment', AttachmentController::class);
