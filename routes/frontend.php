<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CountryController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\UniversityController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
