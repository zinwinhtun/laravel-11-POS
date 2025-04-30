<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

require __DIR__.'/auth.php';
require_once __DIR__.'/user.php';
require_once __DIR__.'/admin.php';

Route::redirect('/', 'login');
// social login
//redirect
Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('social.login');
//callback
Route::get('/auth/{provider}/callback',[SocialLoginController::class,'callBack'])->name('social.callBack');

Route::get('/dashboard', function () {
    return view('Admin.home.list');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/haha',function(){
    return view('auth.custom-login-ui');
});
