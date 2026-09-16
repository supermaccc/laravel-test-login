<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// หน้าแรก - ถ้าล็อกอินแล้วไป Dashboard ถ้ายังไม่ล็อกอินไป Login
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// เส้นทางสำหรับผู้ที่ยังไม่ได้ล็อกอิน (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// เส้นทางสำหรับผู้ที่ล็อกอินแล้วเท่านั้น (Auth Required)
Route::middleware('auth')->group(function () {
    // ออกจากระบบ
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // หน้าหลัก (Dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // จัดการข้อมูลผู้ใช้งาน (CRUD)
    Route::resource('users', UserController::class)->except(['show']);

    // แก้ไขโปรไฟล์ส่วนตัว
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
