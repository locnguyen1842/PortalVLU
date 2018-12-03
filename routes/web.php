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
Route::get('/pi-update/{id}','PIController@getupdate')->name('pi.update');
Route::post('/pi-update/{id}','PIController@postupdate')->name('pi.update');
//show detail a persional
Route::get('/pi-detail/{id}','PIController@getdetail')->name('pi.detail');
