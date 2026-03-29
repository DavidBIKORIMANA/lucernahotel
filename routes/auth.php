<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\OtpPasswordResetController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Password Reset with OTP
    Route::get('forgot-password', [OtpPasswordResetController::class, 'showForgotForm'])
                ->name('password.request');

    Route::post('forgot-password', [OtpPasswordResetController::class, 'sendOtp'])
                ->name('password.email');

    Route::get('reset-password/verify', [OtpPasswordResetController::class, 'showVerifyForm'])
                ->name('password.otp.verify');

    Route::post('reset-password/verify', [OtpPasswordResetController::class, 'verifyOtp'])
                ->name('password.otp.check');

    Route::post('reset-password/resend', [OtpPasswordResetController::class, 'resendOtp'])
                ->name('password.otp.resend');

    Route::get('reset-password/new', [OtpPasswordResetController::class, 'showNewPasswordForm'])
                ->name('password.otp.new');

    Route::post('reset-password/new', [OtpPasswordResetController::class, 'storeNewPassword'])
                ->name('password.otp.store');
});

Route::middleware('auth')->group(function () {
    // Email Verification with OTP
    Route::get('verify-email', [OtpVerificationController::class, 'show'])
                ->name('verification.otp');

    Route::post('verify-email/check', [OtpVerificationController::class, 'verify'])
                ->name('verification.otp.check');

    Route::post('verify-email/resend', [OtpVerificationController::class, 'send'])
                ->middleware('throttle:3,1')
                ->name('verification.otp.resend');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
