<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\{
    DashboardController,
    UserController
};

Route::get('/', [LoginController::class, 'LoginForm'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

// Assign permissions to roles
Route::get('roles/{role}/assign', [RoleController::class, 'assign'])->name('roles.assign');
Route::post('roles/{role}/assign', [RoleController::class, 'assignPermission'])->name('roles.assignPermission');
    Route::resource('/users', UserController::class);

});


