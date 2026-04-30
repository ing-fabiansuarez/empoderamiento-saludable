<?php

use App\Http\Controllers\AdminSessionController;
use App\Http\Controllers\SurveyController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurveyController::class, 'home'])->name('home');
Route::get('/encuesta-findrisc', [SurveyController::class, 'findrisc'])->name('surveys.findrisc');
Route::get('/instrumento-necesidades', [SurveyController::class, 'instrument'])->name('surveys.instrument');

Route::get('/results/{uuid}', [SurveyController::class, 'show'])->name('surveys.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [AdminSessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminSessionController::class, 'login'])->name('login.post');

    Route::middleware(AdminAuth::class)->group(function (): void {
        Route::get('/dashboard', [AdminSessionController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminSessionController::class, 'logout'])->name('logout');
    }
    );
});
