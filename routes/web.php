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



Route::get('/pi-list','PIController@index')->name('pi.index');

//add personal information
Route::get('/pi-add','PIController@getAdd')->name('pi.add');
Route::post('/pi-add','PIController@postAdd')->name('pi.add');
//update personal information
Route::get('/{id}/pi-update','PIController@getupdate')->name('pi.update');
Route::post('/{id}/pi-update','PIController@postupdate')->name('pi.update');
