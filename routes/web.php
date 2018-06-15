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

Route::get('/' , 'AdminController@index');

Route::get('/create_document' , 'AdminController@createDocument');
Route::post('/create_document' , 'AdminController@saveDocument');
Route::get('/edit_document/{document}' , 'AdminController@editDocument')->name('edit_document');
Route::post('/edit_document/{document}' , 'AdminController@updateDocument');
Route::get('/delte_document/{document}' , 'AdminCOntroller@deleteDocument')->name('delete_document');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add_new_location' , 'AdminController@addNewLocation');
Route::get('/add_existing_location' , 'AdminController@addExistingLocation');
Route::get('add_document' , 'AdminController@addDocument');