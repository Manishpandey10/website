<?php

use App\Http\Controllers\users\LoginController;
use App\Http\Controllers\Users\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/user/signup',[SignupController::class , 'index'])->name('register.user.page');
Route::post('/user/register',[SignupController::class, 'registerUser'])->name('register.new.user');

Route::get('user/login',[LoginController::class, 'index'])->name('user.login');
Route::post('/user/login',[LoginController::class, 'verifyLogin'])->name('verify.user.login');
Route::get('/user/logout',[LoginController::class, 'userLogout'])->name('user.logout');