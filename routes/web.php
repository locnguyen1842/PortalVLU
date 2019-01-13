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

Route::prefix('admin')->group(function () {
    //authenticate admin login
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    //reset password
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    //authenicate admin route
    Route::group(['middleware'=>['auth:admin','permission:admin']], function () {
        Route::get('/dashboard', 'PIController@index')->name('admin.pi.dashboard');
        Route::get('/pi-list', 'PIController@index')->name('admin.pi.index');
        //pi detail
        Route::get('/pi-detail/{id}', 'PIController@getdetail')->name('admin.pi.detail');
        //add personal information
        Route::get('/pi-add', 'PIController@getAdd')->name('admin.pi.add');
        Route::post('/pi-add', 'PIController@postAdd')->name('admin.pi.add');
        //update personal information
        Route::get('/pi-update/{id}', 'PIController@getupdate')->name('admin.pi.update');
        Route::post('/pi-update/{id}', 'PIController@postupdate')->name('admin.pi.update');
        //change password
        Route::get('/pi-recovery/{pi_id}', 'PIController@recoverypassword')->name('admin.pi.password.recovery');
        //change chi tiet bang cap
        Route::get('/pi-degree-list/{pi_id}', 'DegreeDetailController@getdegreelist')->name('admin.pi.degree.index');
        //create degree information
        Route::get('/pi-degree-create/{pi_id}', 'DegreeDetailController@getcreatedegree')->name('admin.pi.degree.create');
        Route::post('/pi-degree-create/{pi_id}', 'DegreeDetailController@postcreatedegree')->name('admin.pi.degree.create');
        //update chi tiet bang cap
        Route::get('/pi-degree-update/{degreedetail_id}', 'DegreeDetailController@getupdatedegreedetail')->name('admin.pi.degree.update');
        Route::post('/pi-degree-update/{degreedetail_id}', 'DegreeDetailController@postupdatedegreedetail')->name('admin.pi.degree.update');
        //change password
        Route::get('/pi-changepass', 'AdminController@getchangepass')->name('admin.pi.change.pass');
        Route::post('/pi-changepass', 'AdminController@postchangepass')->name('admin.pi.change.pass');
        //get download template pi
        Route::get('/pi-download-template', 'PIController@downloadtemplate')->name('admin.pi.template.download');
        //get data file import
        Route::post('/pi-get-data-import', 'PIController@getdataimport')->name('admin.pi.import.data');
        //import pi
        Route::post('/pi-import', 'PIController@import')->name('admin.pi.import');
        //delete pi
        Route::get('/pi-delete/{id}', 'PIController@delete')->name('admin.pi.delete');
        //change roles
        Route::post('/pi-role/{pi_id}', 'PIController@rolechange')->name('admin.pi.role.change');
        //delete degree
        Route::get('/pi-degree-delete/{degreedetail_id}', 'DegreeDetailController@delete')->name('admin.pi.degree.delete');

        //workload details of one user
        Route::get('/pi-detail/{pi_id}/workload', 'WorkloadController@getlistworkloadbypi')->name('admin.pi.workload.index');

        //workload all user
        Route::get('/workload-list', 'WorkloadController@index')->name('admin.workload.index');
        //
        //add workload
        Route::get('/workload-add', 'WorkloadController@getadd')->name('admin.workload.add');
        Route::post('/workload-add', 'WorkloadController@postadd')->name('admin.workload.add');

        //update workload
        Route::get('/workload-update/{id}', 'WorkloadController@getUpdateWorkload')->name('admin.workload.update');
        Route::post('/workload-update/{id}', 'WorkloadController@postUpdateWorkload')->name('admin.workload.update');
        //get detail workload
        Route::get('/workload-details/{id_workload}', 'WorkloadController@getWorkloadDetail')->name('admin.workload.detail');
        //delete workload
        Route::get('/workload-delete/{workload_id}', 'WorkloadController@delete')->name('admin.workload.delete');

        //import workload
        Route::post('/workload-import', 'WorkloadController@import')->name('admin.workload.import');
        Route::post('/workload-get-data-import', 'WorkloadController@getdataimport')->name('admin.workload.import.data');
        Route::get('/workload-download-template', 'WorkloadController@downloadtemplate')->name('admin.workload.template.download');

    });
});


Route::prefix('')->group(function () {
    //authenticate admin login/logout
    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');
    Route::get('/logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    //reset password
    Route::get('/password/reset', 'Auth\EmployeeForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
    Route::post('/password/email', 'Auth\EmployeeForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
    Route::get('/password/reset/{token}', 'Auth\EmployeeResetPasswordController@showResetForm')->name('employee.password.reset');
    Route::post('/password/reset', 'Auth\EmployeeResetPasswordController@reset');
    //authenicate employee route
    Route::group(['middleware'=>['auth:employee','permission:employee']], function () {
        Route::get('/pi-detail', 'EmployeeController@getdetail')->name('employee.pi.detail');
        //update personal information
        Route::get('/pi-update', 'EmployeeController@getupdate')->name('employee.pi.update');
        Route::post('/pi-update', 'EmployeeController@postupdate')->name('employee.pi.update');
        //update degree
        Route::get('/pi-degree-create', 'EmployeeController@getcreatedegree')->name('employee.pi.degree.create');
        Route::post('/pi-degree-create', 'EmployeeController@postcreatedegree')->name('employee.pi.degree.create');
        //change password
        Route::get('/pi-changepass', 'EmployeeController@getchangepass')->name('employee.pi.change.pass');
        Route::post('/pi-changepass', 'EmployeeController@postchangepass')->name('employee.pi.change.pass');
        //change chi tiet bang cap
        Route::get('/pi-degree-list', 'EmployeeController@getdegreelist')->name('employee.pi.degree.index');
        //update chi tiet bang cap
        Route::get('/pi-update-degree-detail/{b}', 'EmployeeController@getupdatedegreedetail')->name('employee.pi.update.detail.degree');
        Route::post('/pi-update-degree-detail/{b}', 'EmployeeController@postupdatedegreedetail')->name('employee.pi.update.detail.degree');
        //
        //delete degree employee
        Route::get('/pi-degree-delete/{degreedetail_id}', 'EmployeeController@delete')->name('employee.pi.degree.delete');
        //workload
        Route::get('/workload-list', 'WorkloadController@getWorkloadList_Employee')->name('employee.workload.index');
        //workload details
        Route::get('/workload-details/{id_workload}', 'WorkloadController@getWorkloadDetail_Employee')->name('employee.workload.detail');

    });
});

//show detail a persional
