<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuidanceCenterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
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
    
    // Company Management Routes
    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        
        // Company Creation Flow
        Route::get('/create/basic-info', [CompanyController::class, 'createBasicInfo'])->name('create.basic_info');
        Route::post('/create/basic-info', [CompanyController::class, 'storeBasicInfo'])->name('store.basic_info');
        
        Route::get('/create/legal-info', [CompanyController::class, 'createLegalInfo'])->name('create.legal_info');
        Route::post('/create/legal-info', [CompanyController::class, 'storeLegalInfo'])->name('store.legal_info');
        
        Route::get('/create/contacts', [CompanyController::class, 'createContacts'])->name('create.contacts');
        Route::post('/create/contacts', [CompanyController::class, 'storeContacts'])->name('store.contacts');
        
        Route::get('/create/documents', [CompanyController::class, 'createDocuments'])->name('create.documents');
        Route::post('/create/documents', [CompanyController::class, 'storeDocuments'])->name('store.documents');
        
        Route::get('/create/summary', [CompanyController::class, 'createSummary'])->name('create.summary');
        Route::post('/create', [CompanyController::class, 'store'])->name('store');
        
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('destroy');
        Route::post('/{company}/reject', [CompanyController::class, 'reject'])->name('reject');
    });
});

// Guidance Center Routes
Route::prefix('guidance-center')->group(function () {
    Route::get('/', [GuidanceCenterController::class, 'index'])->name('guidance-center.index');
    Route::get('/export-documentation', [GuidanceCenterController::class, 'exportDocumentation'])->name('guidance-center.export-documentation');
    Route::get('/legality', [GuidanceCenterController::class, 'legality'])->name('guidance-center.legality');
    Route::get('/trade-center', [GuidanceCenterController::class, 'tradeCenter'])->name('guidance-center.trade-center');
    Route::get('/search', [GuidanceCenterController::class, 'search'])->name('guidance-center.search');
});
