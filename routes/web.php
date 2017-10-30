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

Route::get('suggestor/keyword/{keyword}','SuggestorController@searchKeyword');
Route::get('suggestor/location/{location}','SuggestorController@searchLocation');
Route::get('search','SearchController@search');
Route::get('details','DetailController@show');