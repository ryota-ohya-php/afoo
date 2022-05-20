<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\InventoryController;
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
Route::post('inventories/confirm', 'App\Http\Controllers\InventoryController@confirm')->name('inventories.confirm');



Route::post('lendings/confirm', 'App\Http\Controllers\LendingController@confirm')->name('lendings.confirm');
Route::get('lendings/rebook', 'App\Http\Controllers\LendingController@rebook')->name('lendings.rebook');
Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('lendings', LendingController::class);

