<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InmateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
// Auth::routes(['register' => false]); // Disable registration

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inmates Management
    Route::resource('inmates', InmateController::class)->except('destroy');

    // Assessment Management
    Route::prefix('assessments')->name('assessments.')->group(function () {
        Route::get('/', [AssessmentController::class, 'index'])->name('index');
        Route::get('/create', [AssessmentController::class, 'create'])->name('create');
        Route::post('/', [AssessmentController::class, 'store'])->name('store');
        Route::get('/{assessment}', [AssessmentController::class, 'show'])->name('show');
        Route::get('/{assessment}/edit', [AssessmentController::class, 'edit'])->name('edit');
        Route::put('/{assessment}', [AssessmentController::class, 'update'])->name('update');
        Route::post('/{assessment}/submit', [AssessmentController::class, 'submit'])->name('submit');
        Route::post('/{assessment}/approve', [AssessmentController::class, 'approve'])->name('approve');
        Route::post('/{assessment}/reject', [AssessmentController::class, 'reject'])->name('reject');
        Route::get('/{assessment}/pdf', [AssessmentController::class, 'exportPdf'])->name('pdf');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/monthly', [ReportController::class, 'monthly'])->name('monthly');
        Route::get('/statistics', [ReportController::class, 'statistics'])->name('statistics');
        Route::get('/recommendations', [ReportController::class, 'recommendations'])->name('recommendations');
    });

    // Profile & Settings
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', function () {
            return view('profile.index');
        })->name('index');
        Route::put('/update', function () {
            // Profile update logic
        })->name('update');
        Route::put('/password', function () {
            // Password update logic
        })->name('password');
    });
});
// Route::middleware(['auth', 'role:admin,kepala_lapas'])->group(function () {
//     // Routes only for admin and kepala_lapas
//     Route::delete('/inmates/{inmate}', [InmateController::class, 'destroy'])->name('inmates.destroy');
// });
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
