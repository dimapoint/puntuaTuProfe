<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewHelpfulnessController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('teachers.index');
});

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::middleware(['auth', 'throttle:6,1'])->group(function () {
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
});

Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::middleware(['auth', 'throttle:3,1'])->group(function () {
    Route::post('/teachers/{teacher}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{review}/helpfulness', [ReviewHelpfulnessController::class, 'store'])->name('helpfulness.store');
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
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class)->except(['show']);
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
});

require __DIR__.'/auth.php';
