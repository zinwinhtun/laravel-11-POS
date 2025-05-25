<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Models\Payment;

Route::prefix('client')->middleware('user')->group(function () {
    Route::get('client',[UserController::class,'clientUi'])->name('client');
    Route::get('product-detail/{id}',[UserController::class,'productDetail'])->name('product.detail');
    //comment
    Route::post('comment',[CommentController::class,'commentCreate'])->name('comment.save');
    Route::get('comment/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');
    //rating
    Route::post('rating',[RatingController::class,'setRate'])->name('rating');
    // contact mail
    Route::get('contact',[ContactController::class,'index'])->name('contact.index');
    Route::post('send-mail',[ContactController::class,'sendMail'])->name('mail.send');
    //cart
    Route::get('cart',[CartController::class,'cart'])->name('cart.index');
    Route::post('cart',[CartController::class,'addToCart'])->name('cart.addToCart');
    Route::get('delete',[CartController::class,'cartDelete'])->name('cart.delete');

    //payment
    Route::get('cart/payment',[CartController::class,'payment'])->name('cart.payment');
    Route::get('tempstorage',[CartController::class,'tempStorage'])->name('cart.tempstorage');
});
