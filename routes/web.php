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




Route::prefix('admin')->group(function(){
  //authenticate admin login
  Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login/submit','Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
  //authenicate admin route
  Route::group(['middleware'=>['auth:admin']],function(){
    Route::get('/dashboard','PIController@index')->name('admin.pi.dashboard');
    Route::get('/pi-list','PIController@index')->name('admin.pi.index');
    //pi detail
    Route::get('/pi-detail/{id}','PIController@getdetail')->name('admin.pi.detail');
    //add personal information
    Route::get('/pi-add','PIController@getAdd')->name('admin.pi.add');
    Route::post('/pi-add','PIController@postAdd')->name('admin.pi.add');
    //update personal information
    Route::get('/pi-update/{id}','PIController@getupdate')->name('admin.pi.update');
    Route::post('/pi-update/{id}','PIController@postupdate')->name('admin.pi.update');
    //update certification information
    Route::get('/pi-updatedegree/{id}','DegreeController@getupdatedegree')->name('admin.pi.update.degree');
      // doi ten route lai vd: admin.pi.degree.update
    Route::post('/pi-updatedegree/{id}','DegreeController@postupdatedegree')->name('admin.pi.update.degree');
      //change password
      Route::get('/pi-changepass/{employee_id}','PIController@recoverypassword')->name('admin.pi.password.recovery');
  });
});


Route::prefix('')->group(function(){
  //authenticate admin login/logout
  Route::get('/login','Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
  Route::post('/login','Auth\EmployeeLoginController@login')->name('employee.login.submit');
  Route::get('/logout','Auth\EmployeeLoginController@logout')->name('employee.logout');
  //authenicate admin route
  Route::group(['middleware'=>['auth:employee']],function(){

    Route::get('/pi-detail','EmployeeController@getdetail')->name('employee.pi.detail');
    Route::get('/pi-update','EmployeeController@getupdate')->name('employee.pi.update');
    Route::post('/pi-update','EmployeeController@postupdate')->name('employee.pi.update');
    //update degree
      Route::get('/pi-updatedegree','EmployeeController@getupdatedegree')->name('employee.pi.update.degree');
      Route::post('/pi-updatedegree','EmployeeController@postupdatedegree')->name('employee.pi.update.degree');
      //update degree
      Route::get('/pi-changepass','EmployeeController@getchangepass')->name('employee.pi.change.pass');
      Route::post('/pi-changepass','EmployeeController@postchangepass')->name('employee.pi.change.pass');
  });

});

//show detail a persional
