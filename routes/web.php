<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// SuperAdmin
Route::middleware(['auth', 'role:SuperAdmin'])
    ->prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/dashboard',   [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/companies',   [SuperAdminController::class, 'companies'])->name('companies');
        Route::post('/companies',  [SuperAdminController::class, 'storeCompany'])->name('companies.store');
        Route::get('/invite',      [SuperAdminController::class, 'invite'])->name('invite');
        Route::post('/invite',     [SuperAdminController::class, 'storeInvite'])->name('invite.store');
        Route::get('/urls',        [SuperAdminController::class, 'urls'])->name('urls');
    });

// Admin
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard',  [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/company',    [AdminController::class, 'company'])->name('company');
        Route::get('/invite',     [AdminController::class, 'invite'])->name('invite');
        Route::post('/invite',    [AdminController::class, 'storeInvite'])->name('invite.store');
        Route::get('/urls',       [AdminController::class, 'urls'])->name('urls');
        Route::post('/urls',      [AdminController::class, 'storeUrl'])->name('urls.store');
    });

// Member
Route::middleware(['auth', 'role:Member'])
    ->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
        Route::get('/urls',      [MemberController::class, 'urls'])->name('urls');
        Route::post('/urls',     [MemberController::class, 'storeUrl'])->name('urls.store');
    });
