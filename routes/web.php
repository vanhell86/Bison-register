<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('participants', 'ParticipantController');
Route::get('calculateResults', 'ParticipantController@calculateResults')->name('participants.calculate');

Route::get('results', 'ResultController@index')->name('results.index');
Route::get('results/create', 'ResultController@create')->name('results.create');
Route::get('results/calculate', 'ResultController@calculateResults')->name('results.calculate');
Route::post('results', 'ResultController@store')->name('results.store');
