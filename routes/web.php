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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'PagesController@index');

Route::get('/contacts', 'ContactsController@index');
Route::post('/contacts', 'ContactsController@store');

Route::get('/contacts/write', 'ContactsController@write');

Route::get('/contacts/{id}/delete', 'ContactsController@delete');
Route::get('/contacts/{id}/edit', 'ContactsController@edit');

Route::patch('/contacts/{id}/update', 'ContactsController@update');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard');
