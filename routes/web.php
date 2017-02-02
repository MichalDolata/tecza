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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'aktualnosci'], function() {
    Route::get('/', 'NewsController@index');

    Route::get('/{news}', 'NewsController@show')->where('news', '[a-zA-Z0-9-]+');
});

Route::get('/rozgrywki', function() {
    return 'rozgrywki';
});

Route::get('/druzyny', function() {
    return 'druzyny';
});

Route::get('/kontakt', function() {
    return 'kontakt';
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', function() {
       return 'Admin panel';
    });

    Route::group(['prefix' => '/aktualnosci'], function() {
        Route::get('/', 'AdminNewsController@index');

        Route::get('/utworz', 'AdminNewsController@create');
        Route::post('/', 'AdminNewsController@store');

        Route::get('/{news}', 'AdminNewsController@edit');
        Route::post('/{news}', 'AdminNewsController@update');
    });

    Route::get('/druzyny', function() {
       return 'Admin panel - druzyny';
    });

    Route::get('/rozgrywki', function() {
       return 'Admin panel - rozgrywki';
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index');
