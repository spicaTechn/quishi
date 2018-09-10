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

Route::get('/', 'Front\MainPageController@index');

//route to the dashboard
Route::get('/admin', 'Admin\DashboardController@index');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
