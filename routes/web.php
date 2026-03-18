<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('teachers.index');
});

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

Route::middleware('auth')->group(function () {
    Route::post('/teachers/{teacher}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class)->except(['show']);
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)->except(['show']);
});

require __DIR__.'/auth.php';
