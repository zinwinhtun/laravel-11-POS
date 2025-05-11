<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\paymentController;
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

//super admin auth
// admin account CRUD
Route::middleware('super')->prefix('account')->group(function(){
    Route::get('create-admin',[AdminController::class,'adminCreate'])->name('admin.create');
    Route::post('create-admin',[AdminController::class,'store'])->name('admin.store');
    //admin list
    Route::get('admin-list',[AdminController::class,'adminList'])->name('admin.list');
    Route::get('admin-view/{id}',[AdminController::class,'view'])->name('admin.show');
    Route::delete('admin-delete/{id}',[AdminController::class,'delete'])->name('admin.delete');

    // payment
    Route::resource('payment',paymentController::class);
});

