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

Route::get('/hello', function () {
    return view('welcome');
});

Route::get('/statics/{id}', 'StaticController@goods');
Route::get('/', function () {
    return response()->view('welcome')->header('Cache-Control','no-cache');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
