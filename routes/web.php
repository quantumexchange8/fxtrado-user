<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForexController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wallet
    Route::get('/wallet', [WalletController::class, 'wallet'])->name('wallet');
    Route::post('/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::post('/withdrawal', [WalletController::class, 'withdrawal'])->name('wallet.withdrawal');

    Route::get('/deposit_return', [WalletController::class, 'deposit_return'])->name('deposit_return');
    Route::post('/deposit_callback', [WalletController::class, 'deposit_callback'])->name('deposit_callback');

    // Exchange
    Route::get('/forex_pair', [ForexController::class, 'forexPair'])->name('forex_pair');
});

require __DIR__.'/auth.php';