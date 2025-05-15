<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::prefix('user')->middleware('user')->group(function () {
    Route::get('client',[UserController::class,'clientUi'])->name('client');
});
