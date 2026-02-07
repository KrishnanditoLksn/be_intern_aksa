<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'health']);



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', [AuthController::class, 'health']);
    Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
    Route::post('/employees', [EmployeeController::class, 'addEmployees']);
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'deleteEmployees']);
    Route::get('/divisions', [DivisionController::class, 'getAllDivision']);
    Route::put('/employees/{uuid}', [EmployeeController::class, 'updateEmployees']);
});
