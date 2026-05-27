<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Dosen;
use App\Http\Controllers\Mahasiswa;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);
Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

// Lupa Password
Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Auth\ForgotPasswordController::class, 'verifyEmail'])->name('password.email');
Route::get('password/reset/new', [Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Auth\ForgotPasswordController::class, 'reset'])->name('password.update');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', Admin\UserController::class)->except(['show']);
    Route::resource('courses', Admin\CourseController::class)->except(['show']);
    Route::resource('rooms', Admin\RoomController::class)->except(['show']);
    Route::resource('schedules', Admin\ScheduleController::class)->except(['show']);
    Route::get('schedules/{schedule}/enrollments', [Admin\ScheduleController::class, 'enrollments'])->name('schedules.enrollments');
});

// Dosen
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('dashboard', [Dosen\DashboardController::class, 'index'])->name('dashboard');
    Route::get('schedules', [Dosen\ScheduleController::class, 'index'])->name('schedules');
    Route::get('schedules/{schedule}/students', [Dosen\ScheduleController::class, 'students'])->name('schedules.students');
    
    // Pertemuan & Presensi
    Route::get('schedules/{schedule}/meetings', [Dosen\MeetingController::class, 'index'])->name('meetings.index');
    Route::post('schedules/{schedule}/meetings', [Dosen\MeetingController::class, 'store'])->name('meetings.store');
    Route::delete('schedules/{schedule}/meetings/{meeting}', [Dosen\MeetingController::class, 'destroy'])->name('meetings.destroy');
    
    Route::get('schedules/{schedule}/meetings/{meeting}/attendances', [Dosen\AttendanceController::class, 'index'])->name('attendances.index');
    Route::put('schedules/{schedule}/meetings/{meeting}/attendances', [Dosen\AttendanceController::class, 'update'])->name('attendances.update');
});

// Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('dashboard', [Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('schedules', [Mahasiswa\ScheduleController::class, 'index'])->name('schedules');
    Route::get('enrollments', [Mahasiswa\EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::post('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});
