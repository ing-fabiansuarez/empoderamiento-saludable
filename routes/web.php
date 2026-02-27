<?php

use App\Http\Controllers\AdminSessionController;
use App\Http\Controllers\SurveyController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurveyController::class, 'index'])->name('surveys.index');

Route::get('/results/{uuid}', [SurveyController::class, 'show'])->name('surveys.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [AdminSessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminSessionController::class, 'login'])->name('login.post');

    Route::middleware(AdminAuth::class)->group(function (): void {
        Route::get('/dashboard', [AdminSessionController::class, 'dashboard'])->name('dashboard');
        Route::get('/export', [AdminSessionController::class, 'exportSurveys'])->name('export');
        Route::delete('/surveys/{id}', [AdminSessionController::class, 'destroySurvey'])->name('surveys.destroy');
        Route::post('/logout', [AdminSessionController::class, 'logout'])->name('logout');
    }
    );
});
