<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/schedule', 'schedule')->name('schedule');
Route::view('/about', 'about')->name('about');

// Language switching
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
