<?php

use Illuminate\Support\Facades\Route;
use Akhilesh\Laradmin\Http\Controllers\Admin\{
    DashboardController,
    RoleController,
    UserController
};

Route::group(['prefix' => config('laradmin.route.admin_prefix'), 'middleware' => config('laradmin.route.admin_middleware')], function () {


    Route::get('/', [DashboardController::class, 'index'])->name('laradmin.dashboard');
    Route::get('/roles', [RoleController::class, 'index'])->name('laradmin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('laradmin.roles.store');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('laradmin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('laradmin.users.index');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('laradmin.users.assignRole');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('laradmin.users.removeRole');
});
