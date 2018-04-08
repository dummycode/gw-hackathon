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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

// Event routes
Route::get('/', 'EventsController@index');
Route::get('event/{id}', 'EventsController@read');
Route::get('event', function () {
    return view('create_event');
})->middleware('auth');
Route::post('event', 'EventsController@create');

// Auth routes
Auth::routes();
