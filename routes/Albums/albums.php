<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AlbumController;

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

//albums
Route::group(['middleware' => ['auth','lang']], function() {
    Route::resource('/albums', AlbumController::class);
    Route::post('/moveBeforeDelete', [AlbumController::class, 'moveBeforeDelete'])->name('albums.moveBeforeDelete');
});
