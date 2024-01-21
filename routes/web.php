<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AchievementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


//CMS routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('blogs', BlogController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('faqs', FAQController::class);

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});
