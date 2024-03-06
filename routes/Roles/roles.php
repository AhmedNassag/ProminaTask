<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoleController;

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

//roles
Route::group(['middleware' => ['auth','lang']], function() {
    Route::resource('roles', RoleController::class);
    Route::post('rolesDelete', [RoleController::class, 'delete'])->name('roles.delete');
});
