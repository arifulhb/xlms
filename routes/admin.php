<?php


/**
 * User Management
 */
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'role:Admin'], function(){

    Route::get('/', 'UserController@index')->name('all');
    Route::get('/search', 'UserController@search')->name('search');
    Route::get('/new', 'UserController@add')->name('new');
    Route::get('/filter', 'UserController@filter')->name('filter');
    Route::get('/{id}', 'UserController@show')->name('edit');

    Route::post('/', 'UserController@insert')->name('insert');
    Route::put('/{id}', 'UserController@update')->name('update');
    Route::put('/{id}/field', 'UserController@updateField')->name('field.update');
    Route::delete('/{id}', 'UserController@delete')->name('delete');

});


Route::group(['prefix' => 'department', 'as' => 'dept.'], function(){

    Route::get('/', 'DepartmentController@index')->name('all');
    Route::get('/search', 'DepartmentController@search')->name('search');
    Route::get('/{id}', 'DepartmentController@show')->name('edit');
    Route::post('/', 'DepartmentController@insert')->name('insert');
    Route::put('/{id}', 'DepartmentController@update')->name('update');
    Route::delete('/{id}', 'DepartmentController@delete')->name('delete');

});
