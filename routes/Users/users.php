<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;

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

//users
Route::group(['middleware' => ['auth','lang']], function() {
    Route::resource('users', UserController::class);
    Route::get('usersShowNotification/{id}', [UserController::class, 'showNotification'])->name('users.showNotification');
});
