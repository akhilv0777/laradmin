<?php

use Illuminate\Support\Facades\Route;
use Akhilesh\Laradmin\Http\Controllers\Auth\{
    LoginController, RegisterController, LogoutController, ForcePasswordController
};
use Akhilesh\Laradmin\Http\Controllers\User\UserDashboardController;

//
// Auth routes
//
Route::middleware(config('laradmin.route.auth_middleware'))->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('laradmin.login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
    Route::get('/register', [RegisterController::class, 'show'])->name('laradmin.register');
    Route::post('/register', [RegisterController::class, 'store']);
});

//
// Logout
//
Route::post('/logout', LogoutController::class)->middleware(['web', 'auth'])->name('laradmin.logout');

//
// Force password change
//
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/force-password', [ForcePasswordController::class, 'show'])->name('laradmin.force-password.show');
    Route::post('/force-password', [ForcePasswordController::class, 'update'])->name('laradmin.force-password.update');
});

//
// User Dashboard
//
Route::middleware(['web', 'auth', 'role:user', 'must.change.password'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('laradmin.user.dashboard');
});
