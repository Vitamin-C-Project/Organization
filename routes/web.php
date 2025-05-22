<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;

Route::get('/', function () {
    return Inertia::render('landing/Home');
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
        Route::delete('/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');
    });

    Route::prefix('/position')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('position.index');
        Route::post('/', [PositionController::class, 'store'])->name('position.store');
        Route::put('/{id}', [PositionController::class, 'update'])->name('position.update');
        Route::put('/{id}/update-status', [PositionController::class, 'updateStatus'])->name('position.update.status');
        Route::delete('/{id}', [PositionController::class, 'destroy'])->name('position.destroy');
    });

    Route::prefix('/member')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::get('/create', [MemberController::class, 'create'])->name('member.create');
        Route::post('/', [MemberController::class, 'store'])->name('member.store');
        Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::put('/{id}', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
    });

    Route::prefix('/membership')->group(function () {
        Route::get('/', [MembershipController::class, 'index'])->name('membership.index');
        Route::post('/', [MembershipController::class, 'store'])->name('membership.store');
        Route::put('/{id}', [MembershipController::class, 'update'])->name('membership.update');
        Route::put('/{id}/transfer', [MembershipController::class, 'transfer'])->name('membership.transfer');
        Route::delete('/{id}', [MembershipController::class, 'destroy'])->name('membership.destroy');
    });

    Route::prefix('/alumni')->group(function () {
        Route::get('/', [AlumniController::class, 'index'])->name('alumni.index');
        Route::put('/{id}', [AlumniController::class, 'update'])->name('alumni.update');
        Route::delete('/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
