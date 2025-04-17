<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('index');
})->name('login');

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

Route::get('/reset-password/{token}', function () {
    return view('index');
})->name('password.reset');
