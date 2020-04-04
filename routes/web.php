<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/','PostController@index');
Route::get('/home','PostController@index');
Route::get('/dashboard','DashboardController@index');
Route::get('/test','PagesController@test');


// Route::resource('posts','PostController');
ROUTE::get('/posts',"PostController@index");
ROUTE::get('/posts/create',"PostController@create");
ROUTE::post('/posts',"PostController@store");
ROUTE::get('/posts/{id}',"PostController@show");
ROUTE::get('/posts/{id}/edit',"PostController@edit");
ROUTE::post('/posts/update/{id}',"PostController@update");
ROUTE::get('/posts/{id}/delete',"PostController@destroy");

// 
ROUTE::get('posts/{id}/postActions/like',"PostActionsController@like");
ROUTE::post('posts/{id}/postActions/comment',"PostActionsController@comment");


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
