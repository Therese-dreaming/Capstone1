<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/signup', [RegisterController::class, 'show'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-code');
    })->name('verification.notice');

    Route::post('/email/verify', [RegisterController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [RegisterController::class, 'resend'])->name('verification.resend');
});

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/landing', function () {
        return view('landing-page');
    })->name('landing');
});