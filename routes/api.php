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

Route::get('/documents' , 'Api\DocumentController@index');
Route::get('/documents/search' , 'Api\DocumentController@search');
Route::get('/locations' , 'Api\LocationController@index');
Route::get('/documents/{id}' , 'Api\DocumentController@show')->where('id' , '[0-9]+');
Route::get('/locations/{id}' , 'Api\LocationController@show')->where('id' , '[0-9]+');
