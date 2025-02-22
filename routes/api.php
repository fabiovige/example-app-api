<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rotas protegidas pelo Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kids', KidController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return 'API';
});

