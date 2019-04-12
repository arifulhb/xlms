<?php

/**
 * Dashboard
 */

Route::get('/', function(){
    return redirect('/dashboard');
})->name('admin');

Route::get('/dashboard', function(){

    echo 'Dashboard';
})->name('dashboard');

/**
 * User Management
 */
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'role:Admin'], function(){

    Route::get('/', 'UserController@index')->name('all');
    Route::get('/new', 'UserController@add')->name('new');
    Route::get('/{id}', 'UserController@show')->name('edit');

    Route::post('/', 'UserController@insert')->name('insert');
    Route::put('/{id}', 'UserController@update')->name('update');
    Route::put('/{id}/field', 'UserController@updateField')->name('field.update');
    Route::delete('/{id}', 'UserController@delete')->name('delete');

});


Route::group(['prefix' => 'departments', 'as' => 'dept.'], function(){

    Route::get('/', 'DepartmentController@index')->name('all');
    Route::get('/new', 'DepartmentController@add')->name('new');
    Route::get('/{id}', 'DepartmentController@show')->name('edit');
    Route::post('/', 'DepartmentController@insert')->name('insert');
    Route::put('/{id}', 'DepartmentController@update')->name('update');
    Route::delete('/{id}', 'DepartmentController@delete')->name('delete');

});


Route::group(['prefix' => 'job-roles', 'as' => 'jobrole.'], function(){

    Route::get('/', 'JobRoleController@index')->name('all');
    Route::get('/new', 'JobRoleController@add')->name('new');
    Route::get('/{id}', 'JobRoleController@show')->name('edit');
    Route::post('/', 'JobRoleController@insert')->name('insert');
    Route::put('/{id}', 'JobRoleController@update')->name('update');
    Route::delete('/{id}', 'JobRoleController@delete')->name('delete');

});


Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){

    Route::get('/', 'ProfileController@index')->name('show');
    Route::post('/', 'ProfileController@update')->name('update');
    Route::post('/change-password', 'ProfileController@changePassword')->name('change.password');

});
