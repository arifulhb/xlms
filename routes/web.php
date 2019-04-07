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

Auth::routes();

Route::post('/login', 'Auth\LoginController@login')->middleware('user.status');


Route::post('/admin-reset-password', 'Auth\AdminResetPasswordController@adminResetPassword');
Route::get('/home', 'HomeController@index')->name('home');
