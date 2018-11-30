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
    return view('pi.pi-add');
});

//add personal information
Route::get('/pi-add','PIController@getAdd')->name('pi.add');
Route::post('/pi-add','PIController@postAdd')->name('pi.add');
