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

    Route::post('/import', 'UserController@import')->name('import');
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


Route::group(['prefix' => 'course-categories', 'as' => 'course_category.'], function(){

    Route::get('/', 'CourseCategoryController@index')->name('all');
    Route::get('/new', 'CourseCategoryController@add')->name('new');
    Route::get('/{id}', 'CourseCategoryController@show')->name('edit');
    Route::post('/', 'CourseCategoryController@insert')->name('insert');
    Route::put('/{id}', 'CourseCategoryController@update')->name('update');
    Route::delete('/{id}', 'CourseCategoryController@delete')->name('delete');

});


/**
 * Course routes for CRUD purpose
 */
Route::group(['prefix' => 'courses', 'as' => 'course.'], function(){

    Route::get('/', 'CourseController@index')->name('all');
    Route::get('/new', 'CourseController@add')->name('new');
    Route::get('/{id}', 'CourseController@show')->name('edit');
    Route::post('/', 'CourseController@insert')->name('insert');
    Route::put('/{id}', 'CourseController@update')->name('update');
    Route::delete('/{id}', 'CourseController@delete')->name('delete');

});

/**
 * Course moduels to add/edit/delete purpose
 */
Route::group(['prefix' => 'module', 'as' => 'module.'], function(){

    Route::get('/', 'ModuleController@index')->name('all');
    Route::get('/new', 'ModuleController@add')->name('new');
    Route::get('/{id}', 'ModuleController@show')->name('edit');
    Route::post('/', 'ModuleController@insert')->name('insert');
    Route::put('/{id}', 'ModuleController@update')->name('update');
    Route::delete('/{id}', 'ModuleController@delete')->name('delete');

});

/**
 * Course lessons for add/edit/delete purpose
 */
Route::group(['prefix' => 'lesson', 'as' => 'lesson.'], function(){

    Route::get('/', 'LessonController@index')->name('all');
    Route::get('/new', 'LessonController@add')->name('new');
    Route::get('/{id}', 'LessonController@show')->name('edit');
    Route::post('/', 'LessonController@insert')->name('insert');
    Route::put('/{id}', 'LessonController@update')->name('update');
    Route::delete('/{id}', 'LessonController@delete')->name('delete');

});
