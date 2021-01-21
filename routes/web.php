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


Auth::routes();

Route::get('/', 'ProductController@index')->name('index');

Route::get('/create', 'ProductController@create')->name('create')->middleware(['isadmin', 'auth']);

Route::post('/store', 'ProductController@store')->name('store')->middleware(['isadmin', 'auth']);

Route::get('/show/{product}', 'ProductController@show')->name('show')->middleware(['auth']);

Route::post('/store/comment', 'ProductController@store_comment')->name('store_comment')->middleware(['auth']);

Route::post('/like', 'ProductController@like')->name('like')->middleware(['isadmin', 'auth']);


