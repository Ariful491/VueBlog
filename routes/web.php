<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{anypath}', 'HomeController@index')->where('path','.*');

Route::resource('posts', 'PostController');
Route::get('posts-delete/{slug}', 'PostController@destroy');
Route::get('postDetails/{slug}', 'PostController@postDetails');
Route::post('posts/update', 'PostController@postUpdate');


Route::resource('categories', 'CategoryController');
Route::get('categories-delete/{slug}', 'CategoryController@deleteCategory');
Route::get('categoryDetails/{slug}', 'CategoryController@categoryDetails');
Route::post('categories/update', 'CategoryController@categoryUpdate');
Route::post('delete-category-item', 'CategoryController@ItemDelete');
Route::post('category-status-active', 'CategoryController@ItemActive');
Route::post('category-status-inactive', 'CategoryController@IteminActive');

