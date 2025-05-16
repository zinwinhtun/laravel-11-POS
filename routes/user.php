<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::prefix('client')->middleware('user')->group(function () {
    Route::get('client',[UserController::class,'clientUi'])->name('client');
});
