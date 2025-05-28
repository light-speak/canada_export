<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuidanceCenterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AddressController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/console', [DashboardController::class, 'index'])->name('console');
    
    // Address routes
    Route::resource('addresses', AddressController::class);
    
    // Billing Routes
    Route::prefix('billing')->name('billing.')->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('/create', [BillingController::class, 'create'])->name('create');
        Route::post('/', [BillingController::class, 'store'])->name('store');
        Route::get('/{bill}', [BillingController::class, 'show'])->name('show');
    });
    
    // Products Management
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
    
    // Company Management Routes
    Route::prefix('companies')->name('companies.')->group(function () {
        // 查看公司列表 - 所有角色都可以访问
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        
        // 查看单个公司 - 所有角色都可以访问
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
        
        // 创建和删除公司 - 只有admin和user角色可以访问
        Route::middleware(['role:admin,user'])->group(function() {
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
            
            // 删除公司
            Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('destroy');
        });
    });
    
    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        // 所有用户都可以访问的个人资料功能
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        
        // Password Management
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('edit-password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
        
        // Sub-accounts Management - 只有主账户才能管理子账户
        Route::middleware(['role'])->group(function() {
            Route::get('/sub-accounts', [ProfileController::class, 'subAccounts'])->name('sub-accounts');
            Route::get('/sub-accounts/create', [ProfileController::class, 'createSubAccount'])->name('create-sub-account');
            Route::post('/sub-accounts', [ProfileController::class, 'storeSubAccount'])->name('store-sub-account');
            Route::put('/sub-accounts/{subAccount}', [ProfileController::class, 'updateSubAccount'])->name('update-sub-account');
            Route::delete('/sub-accounts/{subAccount}', [ProfileController::class, 'destroySubAccount'])->name('destroy-sub-account');
        });
    });
    
    // Product API Routes
    Route::post('/api/products', [ProductController::class, 'store'])->name('api.products.store');
});

// Guidance Center Routes
Route::prefix('guidance-center')->group(function () {
    Route::get('/', [GuidanceCenterController::class, 'index'])->name('guidance-center.index');
    Route::get('/export-documentation', [GuidanceCenterController::class, 'exportDocumentation'])->name('guidance-center.export-documentation');
    Route::get('/legality', [GuidanceCenterController::class, 'legality'])->name('guidance-center.legality');
    Route::get('/trade-center', [GuidanceCenterController::class, 'tradeCenter'])->name('guidance-center.trade-center');
    Route::get('/search', [GuidanceCenterController::class, 'search'])->name('guidance-center.search');
});

// Certificate Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    
    // Certificate Creation Flow
    Route::prefix('certificates')->name('certificates.')->group(function () {
        // 恢复草稿路由
        Route::get('/drafts/{certificate}/resume', [CertificateController::class, 'resumeDraft'])->name('resume_draft');
        
        Route::get('/create/basic-info', [CertificateController::class, 'createBasicInfo'])->name('create.basic_info');
        Route::post('/create/basic-info', [CertificateController::class, 'storeBasicInfo'])->name('store.basic_info');
        
        Route::get('/create/products', [CertificateController::class, 'createProducts'])->name('create.products');
        Route::post('/create/products', [CertificateController::class, 'storeProducts'])->name('store.products');
        
        Route::get('/create/options', [CertificateController::class, 'createOptions'])->name('create.options');
        Route::post('/create/options', [CertificateController::class, 'storeOptions'])->name('store.options');
        
        Route::get('/create/documents', [CertificateController::class, 'createDocuments'])->name('create.documents');
        Route::post('/create/documents', [CertificateController::class, 'storeDocuments'])->name('store.documents');
        
        Route::get('/create/delivery', [CertificateController::class, 'createDelivery'])->name('create.delivery');
        Route::post('/create/delivery', [CertificateController::class, 'storeDelivery'])->name('store.delivery');
        
        Route::get('/create/summary', [CertificateController::class, 'createSummary'])->name('create.summary');
        Route::post('/create/summary', [CertificateController::class, 'storeSummary'])->name('store.summary');
    });
    
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
});
