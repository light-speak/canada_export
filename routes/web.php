<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuidanceCenterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/console');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/console', [DashboardController::class, 'index'])->name('console');
});

// Guidance Center Routes
Route::prefix('guidance-center')->group(function () {
    Route::get('/', [GuidanceCenterController::class, 'index'])->name('guidance-center.index');
    Route::get('/export-documentation', [GuidanceCenterController::class, 'exportDocumentation'])->name('guidance-center.export-documentation');
    Route::get('/legality', [GuidanceCenterController::class, 'legality'])->name('guidance-center.legality');
    Route::get('/trade-center', [GuidanceCenterController::class, 'tradeCenter'])->name('guidance-center.trade-center');
    Route::get('/search', [GuidanceCenterController::class, 'search'])->name('guidance-center.search');
});
