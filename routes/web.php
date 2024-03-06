<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralController;

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



Auth::routes(['register' => false]);


Route::middleware('lang')->group( function () {
    Route::prefix('lang')->name('lang.')->group( function () {
        Route::controller(LangController::class)->group( function () {
            Route::get('/ar' ,  'ar')->name('ar');
            Route::get('/en' ,  'en')->name('en');
        });
    });
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});



//general routes
Route::get('show_file/{folder_name}/{photo_name}', [GeneralController::class, 'show_file'])->name('show_file');
Route::get('download_file/{folder_name}/{photo_name}', [GeneralController::class, 'download_file'])->name('download_file');
Route::get('allNotifications', [GeneralController::class, 'allNotifications'])->name('allNotifications');
Route::get('markAllAsRead', [GeneralController::class, 'markAllAsRead'])->name('markAllAsRead');
// Route::get('/{page}', [GeneralController::class, 'index']);

