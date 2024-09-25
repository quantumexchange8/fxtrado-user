<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('store', [AuthController::class, 'store'])->name('store');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/storeRegister', [RegisterController::class, 'storeRegister'])->name('storeRegister');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('Auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');