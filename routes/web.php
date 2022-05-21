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

// resource以外のルーティング

Route::get('/', function () {
    return view('home.index');
});

Route::get('inventories/confirm', 'App\Http\Controllers\InventoryController@confirm')->name('inventories.confirm');

Route::post('menbers/confirm', 'App\Http\Controllers\MemberController@confirm')->name('members.confirm');

Route::post('lendings/confirm', 'App\Http\Controllers\LendingController@confirm')->name('lendings.confirm');
Route::get('lendings/rebook', 'App\Http\Controllers\LendingController@rebook')->name('lendings.rebook');

Route::post('books/create/confirm', 'App\Http\Controllers\BookController@confirm_create')->name('books.confirm-create');
Route::post('books/edit/confirm', 'App\Http\Controllers\BookController@confirm_edit')->name('books.confirm-edit');

// resourceのルーティング
Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('lendings', LendingController::class);

