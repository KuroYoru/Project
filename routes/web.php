<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('book/books', 'BookController');
Route::get('/', 'BookController@index');
Route::get('/search','BookController@search');
Route::get('book/books/{book}/buy','BookController@buy')->name('buy');
Route::get('/', 'BookController@bought');
Route::get('/book/bookXML', 'BookController@bookXML')->name('bookXML');
Route::get('/book/showOwnedBookXML', 'BookController@OwnedBookXML')->name('OwnedBookXML');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
