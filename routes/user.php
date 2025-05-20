<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::prefix('client')->middleware('user')->group(function () {
    Route::get('client',[UserController::class,'clientUi'])->name('client');
    Route::get('product-detail/{id}',[UserController::class,'productDetail'])->name('product.detail');
    Route::post('comment',[CommentController::class,'commentCreate'])->name('comment.save');
    Route::post('comment/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');
});
