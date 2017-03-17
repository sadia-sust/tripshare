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
Route::get('profile/{id}','PostsController@profile')->name('profile');

// search with tag/location
Route::get('search', 'SearchController@search')->name('search');
Route::get('search/{sort}', 'SearchController@sort')->name('sort');

Route::group(['middleware' => 'auth'], function () {
  Route::get('post/create', 'PostsController@create')->name('post.create');
  Route::post('post/create', 'PostsController@store')->name('post.store');
  Route::post('post/{_id}/comment', 'PostsController@comment')->name('post.comment');
  Route::get('post/upvote/{id}','PostsController@upvote')->name('post.upvote');
  Route::get('post/downvote/{id}','PostsController@downvote')->name('post.downvote');
  
});