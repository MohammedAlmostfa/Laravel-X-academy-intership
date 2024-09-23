<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\InstructorController;
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
Route::resource('specialty', SpecialtyController::class);
Route::resource('intructor', InstructorController::class);
Route::resource('course', CourseController::class);
Route::post('/course/{courseId}/instructor/{instructorId}', [CourseController::class, 'addInstructors']);
Route::delete('/course/{courseId}/instructor/{instructorId}', [CourseController::class, 'deletinstructors']);
