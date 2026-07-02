<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\LogoutController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\ForgotPasswordController;
use App\Http\Controllers\api\ResetPasswordController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', LogoutController::class);
    Route::get('/dashboard', DashboardController::class);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/department', DepartmentController::class);
Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/forgot_password', ForgotPasswordController::class);
Route::post('/reset_password', ResetPasswordController::class);
