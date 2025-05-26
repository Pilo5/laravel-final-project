<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\EmployeeController;

// Default route redirects to login view
Route::get('/', [UserAccountController::class, 'loginView']);

Route::get('/login', [UserAccountController::class, 'loginView']);
Route::post('/login', [UserAccountController::class, 'login']);
Route::get('/logout', [UserAccountController::class, 'logout']);

// Update password (for users)
Route::get('/update-password', [UserAccountController::class, 'updatePasswordView']);
Route::post('/update-password', [UserAccountController::class, 'updatePassword']);

// User Dashboard
Route::get('/user-dashboard', [UserAccountController::class, 'userDashboard']);

// Admin Routes (CRUD)
Route::middleware(['App\Http\Middleware\SessionUserAccountMW'])->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index']); // admin dashboard
    Route::get('/add-employee', [EmployeeController::class, 'create']);
    Route::post('/add-employee', [EmployeeController::class, 'store']);
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
    Route::put('/edit-employee/{id}', [EmployeeController::class, 'update']);
    Route::get('/delete-employee/{id}', [EmployeeController::class, 'destroy']);
    Route::get('/toggle-status/{id}', [EmployeeController::class, 'toggleStatus']);
});
