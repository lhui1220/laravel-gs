<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/heroes', 'HeroController@getHeroes');
Route::post('/heroes', 'HeroController@createHero');
Route::put('/heroes/{id}', 'HeroController@updateHero');
Route::delete('/heros/{id}', 'HeroController@deleteHero');

Route::post('/file', 'StorageController@saveFile');
Route::get('/file', 'StorageController@getFile');
Route::post('/dirs', 'StorageController@mkdir');
Route::delete('/dirs', 'StorageController@delDir');
Route::get('/files', 'StorageController@getFiles');
Route::get('/files/all', 'StorageController@getAllFiles');

Route::get('/pay', 'PayController@pay');

Route::get('/refund', 'PayController@refund');

Route::get('/callback', 'PayController@callback');

Route::get('/notify', 'PayController@notify');
