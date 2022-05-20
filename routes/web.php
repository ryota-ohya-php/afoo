<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendingController;
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

Route::get('/', function () {
    return view('home.index');
});

Route::post('lending/confirm', 'App\Http\Controllers\LendingController@confirm')->name('lending.confirm');
Route::resource('lending',LendingController::class);

