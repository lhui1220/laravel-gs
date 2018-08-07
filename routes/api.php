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


Route::post('/users', 'UserController@create');
Route::get('/users/{id}', 'UserController@get');
Route::get('/users/{user_id}/articles', 'ArticleController@articles');

Route::get('/articles/{id}', 'ArticleController@info');
Route::post('/articles/{article_id}/tags/{tag_id}', 'ArticleController@addTag');
Route::get('/articles/{id}/tags', 'ArticleController@tags');
Route::post('/articles', 'ArticleController@create');

Route::post('/tags', 'TagController@create');
Route::get('/tags/{id}/articles', 'TagController@articles');

Route::get('/interview/ucfirst', 'InterviewController@ucfirst');
Route::get('/interview/regex', 'InterviewController@regex');
Route::get('/interview/dblock', 'InterviewController@dblock');

Route::get('/interview/bulk_insert/orm', 'InterviewController@multInsertUseORM');
Route::get('/interview/bulk_insert/pdo', 'InterviewController@multInsertUsePdo');
Route::get('/interview/bulk_insert/pdo_nobind', 'InterviewController@multInsertUsePdoNoBind');

Route::post('/file', 'StorageController@saveFile');
Route::get('/file', 'StorageController@getFile');
Route::delete('/file', 'StorageController@delFile');
Route::post('/dirs', 'StorageController@mkdir');
Route::delete('/dirs', 'StorageController@delDir');
Route::get('/files', 'StorageController@getFiles');
Route::get('/files/all', 'StorageController@getAllFiles');

Route::get('/reflection/class', 'ReflectionControllerTest@testReflectionClass');
Route::get('/reflection/properties', 'ReflectionControllerTest@testReflectionProperty');

Route::post('/events','EventController@fireOrderShipEvent');

Route::post('/jobs', 'JobController@pub');

Route::get('/pay', 'PayController@pay');
Route::get('/refund', 'PayController@refund');
Route::get('/callback', 'PayController@callback');
Route::get('/notify', 'PayController@notify');

Route::get('/cors/simple', 'CorsController@simple');
Route::post('/cors/preflighted', 'CorsController@preflighted');

Route::get('/pdf', 'PdfController@export');

Route::get('/pdf', 'PdfController@export');

