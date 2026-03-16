<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SavingAccountController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\SavingTypeController;
use App\Http\Controllers\LoanSchemeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MemberGroupController;
use App\Http\Controllers\AnalysisController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pengaturan
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Laporan
    Route::get('shu', [ReportController::class, 'shu'])->name('reports.shu');
    Route::get('reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
    Route::get('analysis', [AnalysisController::class, 'index'])->name('analysis.index');
    
    // Master Data
    Route::resource('saving-types', SavingTypeController::class);
    Route::resource('loan-schemes', LoanSchemeController::class);
    
    // Operasional
    Route::resource('members', MemberController::class);
    Route::resource('savings', SavingAccountController::class);
    Route::post('savings/{account}/deposit', [SavingAccountController::class, 'deposit'])->name('savings.deposit');
    Route::post('savings/{account}/withdraw', [SavingAccountController::class, 'withdraw'])->name('savings.withdraw');
    Route::resource('loans', LoanController::class);
    Route::post('loans/{loan}/pay', [LoanController::class, 'payInstallment'])->name('loans.pay');
    
    Route::resource('member-groups', MemberGroupController::class);
    
    // Keuangan
    Route::resource('accounts', ChartOfAccountController::class);
    Route::resource('journals', JournalEntryController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
