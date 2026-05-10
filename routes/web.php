<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Dosen;
use App\Http\Controllers\Mahasiswa;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

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
});

// Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('dashboard', [Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('schedules', [Mahasiswa\ScheduleController::class, 'index'])->name('schedules');
    Route::get('enrollments', [Mahasiswa\EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::post('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});
