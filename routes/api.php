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
Route::put('/heroes/{}', 'HeroController@updateHero');
Route::delete('/heros/{id}', 'HeroController@deleteHero');

Route::get('/pay', 'PayController@pay');

Route::get('/refund', 'PayController@refund');

Route::get('/callback', 'PayController@callback');

Route::get('/notify', 'PayController@notify');
