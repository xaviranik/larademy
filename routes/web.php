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

Route::get('/', 'FrontendController@welcome')->name('welcome');

Auth::routes();

Route::get('/logout', 'FrontendController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/series/{series}', 'FrontendController@series')->name('series');


Route::middleware('auth')->group(function() {
    Route::get('/watch-series/{series}', 'WatchSeriesController@index')->name('series.learning');
    Route::get('series/{series}/lesson/{lesson}', 'WatchSeriesController@showLesson')->name('series.watch');

    Route::post('/series/complete-lesson/{lesson}', 'WatchSeriesController@completeLesson');
});
