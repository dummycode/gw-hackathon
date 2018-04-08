<?php

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

// General routes
Route::get('/home', 'HomeController@index')->name('home');

// Event routes
Route::get('/', 'EventsController@index');
Route::get('event/{id}', 'EventsController@read')->name('viewevent');
Route::get('event', function () {
    return view('create_event');
})->middleware('auth');
Route::post('event', 'EventsController@create')->name('event');

// Auth routes
Auth::routes();
