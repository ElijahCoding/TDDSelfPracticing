<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads/create','ThreadController@create');
Route::post('/threads','ThreadController@store');

Route::get('/threads','ThreadController@index');
Route::get('/threads/{channel}','ThreadController@index');


Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy');
Route::post('/threads/{channel}/{thread}/replies','ReplyController@store');

Route::post('/replies/{reply}/favorites','FavoriteController@store');


Route::get('/profiles/{user}','ProfileController@show')->name('profile');
