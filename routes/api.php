<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return Auth::user();
});

Route::resource('tasks', TaskController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('auth:sanctum');
