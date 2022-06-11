<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'post'])
                ->middleware('guest')
                ->name('register.post');

Route::get('/register-confirm', [RegisteredUserController::class, 'confirm'])
                ->middleware('guest')
                ->name('register-confirm');

Route::get('/register-completion', [RegisteredUserController::class, 'completion'])
                ->middleware(['auth'])
                ->name('register-completion');                

Route::post('/register-confirm', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register-confirm.store');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

// パスワード確認
Route::post('/forgot-password', [PasswordResetLinkController::class, 'request'])
                ->name('password.request');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'index'])
                ->name('password');

// パスワードリセット
Route::get('/reset-password', [NewPasswordController::class, 'index'])
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
            

