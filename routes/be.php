<?php

use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/list', [ControllersCategoryController::class, 'list'])->name('admin.category.list');
        Route::get('add', [ControllersCategoryController::class, 'add'])->name('admin.category.add');
        Route::post('doAdd', [ControllersCategoryController::class, 'doAdd'])->name('admin.category.doAdd');
        Route::get('edit/{id}', [ControllersCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('doEdit', [ControllersCategoryController::class, 'doEdit'])->name('admin.category.doEdit');
        Route::get('delete/{id}', [ControllersCategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/list', [UserController::class, 'list'])->name('admin.user.list');
        Route::get('add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('doAdd', [UserController::class, 'doAdd'])->name('admin.user.doAdd');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('doEdit', [UserController::class, 'doEdit'])->name('admin.user.doEdit');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    });
});
