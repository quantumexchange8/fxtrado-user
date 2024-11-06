<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('deposit_callback', [WalletController::class, 'depositCallback'])->name('depositCallback');

Route::get('/switch-language/{lang}', [LanguageController::class, 'switchLanguage'])->name('switch.language');

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wallet
    Route::get('/wallet', [WalletController::class, 'wallet'])->name('wallet');
    Route::get('/wallet_transaction', [WalletController::class, 'walletTransaction'])->name('wallet_transaction');
    Route::post('/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::post('/withdrawal', [WalletController::class, 'withdrawal'])->name('wallet.withdrawal');

    Route::get('deposit_return', [WalletController::class, 'deposit_return'])->name('deposit_return');

    // Exchange
    Route::get('/forex_pair', [ForexController::class, 'forexPair'])->name('forex_pair');
    Route::post('/openOrders', [ForexController::class, 'openOrders'])->name('openOrders');
    Route::post('/closeOrder', [ForexController::class, 'closeOrder'])->name('closeOrder');
    Route::get('/getChartData', [ForexController::class, 'getChartData'])->name('getChartData');
    Route::get('/getCandles', [ForexController::class, 'getCandles'])->name('getCandles');
    Route::get('/getRealTimeOHLC', [ForexController::class, 'getRealTimeOHLC'])->name('getRealTimeOHLC');
    Route::get('/group-symbols', [ForexController::class, 'getGroupSymbols'])->name('getGroupSymbols');

    // Orders
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

    // profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/updateSecurity', [ProfileController::class, 'updateSecurity'])->name('updateSecurity');
    
});

require __DIR__.'/auth.php';