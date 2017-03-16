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
    return redirect('timeline');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('create', 'HomeController@create')->name('create');
Route::post('create', 'HomeController@store')->name('store');
Route::get('edit/{id}', 'HomeController@edit')->name('edit');
Route::put('edit/{id}', 'HomeController@update')->name('update');
Route::get('delete/{id}', 'HomeController@delete')->name('delete');

//post public timeline
Route::get('timeline', 'PostsController@index')->name('timeline');
Route::get('post/details/{id}','PostsController@view')->name('post.details');

//
Route::group(['middleware' => 'auth'], function () {
  Route::get('post/create', 'PostsController@create')->name('post.create');
  Route::post('post/create', 'PostsController@store')->name('post.store');
});