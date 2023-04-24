<?php

use App\Http\Controllers\V1\Auth\AdminController;
use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use App\Http\Middleware\CheckRoleEmployeMiddleware;
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
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware([CheckRoleAdminMiddleware::class])->group(function () {
        Route::post('/createAdmin', [AdminController::class, 'createAdmin']);

    });
    Route::middleware([CheckRoleEmployeMiddleware::class])->group(function () {

    });

});
