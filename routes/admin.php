<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    //profile
    Route::get('profile',[ProfileController::class,'profile'])->name('profile.index');
    Route::get('change/password',[ProfileController::class,'passwordChange'])->name('keyword.change');
    Route::post('change/password',[ProfileController::class,'passwordUpdate'])->name('keyword.save');
    //category
    Route::resource('category', CategoryController::class);
    //product
    Route::resource('product', ProductController::class);
    Route::get('limit',[ProductController::class,'stockLimit'])->name('product.limit');//stock limit
});

