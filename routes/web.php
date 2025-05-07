<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AcademicYearController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/academic-year')->group(function () {
        Route::get('/', [AcademicYearController::class, 'index'])->name('academic.year.index');
        Route::post('/', [AcademicYearController::class, 'store'])->name('academic.year.store');
        Route::put('/{id}', [AcademicYearController::class, 'update'])->name('academic.year.update');
        Route::put('/{id}/update-status', [AcademicYearController::class, 'updateStatus'])->name('academic.year.update.status');
        Route::delete('/{id}', [AcademicYearController::class, 'destroy'])->name('academic.year.destroy');
    });

    Route::prefix('/grade')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('grade.index');
        Route::post('/', [GradeController::class, 'store'])->name('grade.store');
        Route::put('/{id}', [GradeController::class, 'update'])->name('grade.update');
        Route::put('/{id}/update-status', [GradeController::class, 'updateStatus'])->name('grade.update.status');
        Route::delete('/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
