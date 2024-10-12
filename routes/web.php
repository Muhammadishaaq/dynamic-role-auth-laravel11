<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


/* login */
Route::get('/', [LoginController::class, 'loginForm'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
   
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    
    // Assign permissions to roles
    Route::get('roles/{role}/assign', [RoleController::class, 'assign'])->name('roles.assign');
    Route::post('roles/{role}/assign', [RoleController::class, 'assignPermission'])->name('roles.assignPermission');
    /* Employee routes */
    Route::resource('employees', EmployeeController::class); 


});


