<?php

use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\Admin;

Route::prefix('/admin')->middleware(Admin::class)->group(function () {
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

    Route::prefix('/product')->group(function () {
        Route::get('/list', [ProductController::class, 'list'])->name('admin.product.list');
        Route::get('add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::post('doAdd', [ProductController::class, 'doAdd'])->name('admin.product.doAdd');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('doEdit', [ProductController::class, 'doEdit'])->name('admin.product.doEdit');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
    Route::post('/upload', [ProductController::class, 'upload'])->name('ckeditor.upload');
    Route::get('/home', [LoginController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/show-login', [LoginController::class, 'showForm'])->name('show.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
