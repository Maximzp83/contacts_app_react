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





Route::group(["prefix"=>"backend"], function() {
    Route::get('/', 'PagesController@index');

    Route::get('/contacts', 'ContactsController@index');
    Route::post('/contacts', 'ContactsController@store');

    Route::get('/contacts/write', 'ContactsController@write');

    Route::get('/contacts/{id}/delete', 'ContactsController@delete');
    Route::get('/contacts/{id}/edit', 'ContactsController@edit');

    Route::put('/contacts/{id}/update', 'ContactsController@update');
//    Route::post('login', 'Auth\LoginController@login');
    Auth::routes();

//    Route::post('/register', 'Auth\RegisterController@register');
});


Route::get('/{slug?}', [function($slug) {
    return view('app');
}])->where('slug', '.+');

//);



//
//Route::get('/dashboard', 'HomeController@dashboard');
