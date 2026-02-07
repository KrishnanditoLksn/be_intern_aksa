<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'health']);


Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/', [AuthController::class, 'health']);
        Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
        Route::post('/employee/create', [EmployeeController::class, 'addEmployees']);
        Route::delete('/employee/delete/{id} ', [EmployeeController::class, 'deleteEmployees']);
    });
});
