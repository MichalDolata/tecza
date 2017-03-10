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

use Illuminate\Http\Request;

Route::get('/', 'IndexController@index');

Route::group(['prefix' => 'aktualnosci'], function() {
    Route::get('/', 'NewsController@index');

    Route::get('/{news}', 'NewsController@show')->where('news', '[a-zA-Z0-9-]+');
});

Route::group(['prefix' => 'rozgrywki'], function() {
    Route::get('/', 'ContestController@index');

    Route::get('/{contest}', 'ContestController@show')->where('contest', '[a-zA-Z0-9-]+');
});

Route::group(['prefix' => 'druzyny'], function() {
    Route::get('/', 'TeamController@index');
    Route::get('/{team}', 'TeamController@show')->where('team', '[a-zA-Z0-9-]+');
});

Route::get('/kontakt', function() {
    return 'kontakt';
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', function() {
       return redirect()->action('AdminNewsController@index');
    });

    Route::group(['prefix' => '/aktualnosci'], function() {
        Route::get('/', 'AdminNewsController@index');

        Route::get('/dodaj', 'AdminNewsController@create');
        Route::post('/', 'AdminNewsController@store');

        Route::get('/{news}', 'AdminNewsController@edit');
        Route::post('/{news}', 'AdminNewsController@update');
    });

    Route::group(['prefix' => '/druzyny'], function() {
        Route::get('/', 'AdminTeamController@index');

        Route::get('/dodaj', 'AdminTeamController@create');
        Route::post('/', 'AdminTeamController@store');

        Route::get('/{team}', 'AdminTeamController@edit');
        Route::post('/{team}', 'AdminTeamController@update');

        Route::put('/{team}/czlonkowie', 'AdminTeamController@addMember');
        Route::delete('/{team}/czlonkowie', 'AdminTeamController@deleteMember');
    });

    Route::group(['prefix' => '/czlonkowie'], function() {
        Route::get('/', 'AdminTeamMemberController@index');

        Route::get('/dodaj', 'AdminTeamMemberController@create');
        Route::post('/', 'AdminTeamMemberController@store');

        Route::get('/{member}', 'AdminTeamMemberController@edit');
        Route::post('/{member}', 'AdminTeamMemberController@update');
    });

    Route::resource('kluby', 'AdminClubController', [
        'except' => ['show'],
        'parameters' => ['kluby' => 'club']
    ]);

    Route::resource('rozgrywki', 'AdminContestController', [
        'except' => ['show'],
        'parameters' => ['rozgrywki' => 'contest']
    ]);

    Route::group(['prefix' => 'rozgrywki'], function() {
        Route::put('{contest}/edytuj/kluby', 'AdminContestController@addClub');
        Route::delete('{contest}/edytuj/kluby', 'AdminContestController@deleteClub');

        Route::get('{contest}/edytuj/terminarz', 'AdminTimetableController@edit');
        Route::put('{contest}/edytuj/terminarz', 'AdminTimetableController@update');
    });

    Route::get('nastepne-spotkanie', 'AdminNextMatchController@edit');
    Route::put('nastepne-spotkanie', 'AdminNextMatchController@update');
});

Auth::routes();