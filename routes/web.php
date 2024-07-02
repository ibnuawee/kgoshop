<?php

use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('home', function(){
        return view('dashboard.home');
    })->name('home');

    Route::get('edit-profile', function(){
        return view('dashboard.profile');
    })->name('profile.edit');

    Route::resource('user', UserController::class);
});