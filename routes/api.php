<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/list', 'BookController@index');
Route::post('/store', 'BookController@store');
Route::post('/update', 'BookController@update');
Route::post('/delete', 'BookController@delete');


