<?php

use App\Http\Controllers\V1\AdminController;
use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\EmployeController;
use App\Http\Controllers\V1\EntrepriseController;
use App\Http\Controllers\V1\InvitationController;
use App\Http\Middleware\CheckIfEmployeeIsConfirmed;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use App\Http\Middleware\CheckRoleEmployeMiddleware;
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

        Route::get('/ListOfEmployes', [EmployeController::class, 'ListOfEmployes']);
        Route::post('/createEntreprise', [EntrepriseController::class, 'createEntreprise']);
        Route::put('/editEntreprise', [EntrepriseController::class, 'editEntreprise']);
        Route::delete('/deleteEntreprise', [EntrepriseController::class, 'deleteEntreprise']);

        Route::get('/getEntreprises', [EntrepriseController::class, 'getEntreprises']);
        Route::post('/sendInvitation', [InvitationController::class, 'sendInvitation']);
        Route::get('/MyInvitations', [InvitationController::class, 'MyInvitations']);
        Route::put('/cancel/invitation/{id}', [InvitationController::class, 'cancelInvitation']);

    });
    Route::middleware([CheckRoleEmployeMiddleware::class])->group(function () {
        Route::put('/edit/myAccount', [EmployeController::class, 'editMyAccount']);
        Route::middleware([CheckIfEmployeeIsConfirmed::class])->group(function () {
            Route::get('myCompanyInfo', [EmployeController::class, 'myCompanyInfo']);
            Route::get('mycolleaguesInfo', [EmployeController::class, 'mycolleaguesInfo']);
            Route::get('myInfo', [EmployeController::class, 'myInfo']);
        });
    });

});
