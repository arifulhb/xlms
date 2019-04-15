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
    return view('welcome');
});


/**
 * Login as Admin
 */

Route::get('/login/as-admin', 'Auth\LoginController@getAsAdmin');
Route::post('/login/as-admin', 'Auth\LoginController@postAsAdmin')->name('post_login_as_admin');
Route::post('/login/as-user', 'Auth\LoginController@postAsUser')->name('post_login_as_user');

Auth::routes();

Route::post('/login', 'Auth\LoginController@login')->middleware('user.status');
// Route::get('/password/set', 'Auth\LoginController@setPassword');

Route::post('/admin-reset-password', 'Auth\AdminResetPasswordController@adminResetPassword');
Route::get('/home', 'HomeController@index')->name('home');
