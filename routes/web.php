<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\userServiceController;
use App\Http\Controllers\ProfileController;

Route::get('/home', function () {
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

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/services', [ServiceController::class, 'index'])->name('services'); // Changed from 'admin.services' to 'services'
    Route::get('/service/request/{type}', [ServiceController::class, 'showRequestForm'])->name('service.request.form');
    Route::post('/service/request/store', [ServiceController::class, 'store'])->name('service.request.store');
    Route::post('/services/{schedule}/approve', [ServiceController::class, 'approveService'])->name('services.approve');
    Route::post('/services/{schedule}/cancel', [ServiceController::class, 'cancelService'])->name('services.cancel');
    Route::delete('/services/history/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/services/history', [ServiceController::class, 'history'])->name('services.history');
    Route::get('/services/{type}/events', [ServiceController::class, 'getEvents'])->name('services.events');
    Route::get('/services/{type}/events/{date}', [ServiceController::class, 'getDateEvents'])->name('services.date.events');
});


// Staff Routes
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [ServiceController::class, 'staffDashboard'])->name('staff.dashboard');
});

// Priest Routes
Route::prefix('priest')->middleware(['auth', 'role:priest'])->group(function () {
    Route::get('/dashboard', [ServiceController::class, 'priestDashboard'])->name('priest.dashboard');
});

// User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/services/book', [userServiceController::class, 'bookingForm'])->name('services.book');
    Route::post('/services', [BookingController::class, 'store'])->name('services.store');
    Route::get('/services/my-bookings', [userServiceController::class, 'myBookings'])->name('services.my-bookings');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/services', function () {
    return view('userServices');
})->name('services');
