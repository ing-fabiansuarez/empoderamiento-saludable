<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurveyController::class, 'index'])->name('surveys.index');
Route::post('/survey', [SurveyController::class, 'store'])->name('surveys.store');
