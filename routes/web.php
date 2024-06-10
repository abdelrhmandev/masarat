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

/**
 * For kashif connection
 */
Route::post('/kashifinsert', 'App\Http\Controllers\KashifController@recive');
Route::post('/kashifselect', 'App\Http\Controllers\KashifController@output');

Route::group(['middleware' => ['web']], function () {
    $FILLCONTROLLER = 'App\Http\Controllers\FillController@index';

    Route::get('/', $FILLCONTROLLER)->name('fill')->middleware('CheckExpiry');
    Route::any('/fill', $FILLCONTROLLER)->name('fills')->middleware('CheckExpiry');
    Route::get('/fillForm', 'App\Http\Controllers\FormsController@index')->name('fillForm');
    Route::post('/validateFillForm', 'App\Http\Controllers\FillController@validateFillForm')->name('validateFillForm')->middleware('CheckExpiry');
    Route::get('/showInterventions/{id}/{confirmation_code}/{int_id?}', 'App\Http\Controllers\FillController@showInterventions')->name('showInterventions')->middleware('CheckExpiry');
    Route::post('/answers', 'App\Http\Controllers\FillController@answers')->name('answers');
    Route::get('/trackingForm', 'App\Http\Controllers\TrackingController@tracking')->name('trackingForm');
    Route::get('/tracking', 'App\Http\Controllers\TrackingController@index')->name('tracking');
    Route::get('/oneTrack', 'App\Http\Controllers\TrackingController@oneTrack');
});