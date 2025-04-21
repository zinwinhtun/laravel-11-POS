<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::prefix('user')->middleware('user')->group(function () {
    Route::get('home',[UserController::class,'home'])->name('user.home');
});
