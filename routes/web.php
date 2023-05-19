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

//-------------------------------------------- Frontend --------------------------------------------
Route::get('/','App\Http\Controllers\HomeController@indexpage');
Route::get('/home','App\Http\Controllers\HomeController@index');


//-------------------------------------------- Backend --------------------------------------------
Route::get('/admin','App\Http\Controllers\AccountController@index');
Route::post('/admin-login','App\Http\Controllers\AccountController@admin_login');
Route::get('/dashboard','App\Http\Controllers\AccountController@dashboard');
//Category
Route::get('/add-category','App\Http\Controllers\CategoryController@add_category');
Route::post('save-category','App\Http\Controllers\CategoryController@save_category');
Route::get('/list-category','App\Http\Controllers\CategoryController@list_category');
Route::get('/edit-category/{category_id}','App\Http\Controllers\CategoryController@edit_category');
Route::post('update-category/{category_id}','App\Http\Controllers\CategoryController@update_category');
Route::get('/delete-category/{category_id}','App\Http\Controllers\CategoryController@delete_category');
//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::post('save-product','App\Http\Controllers\ProductController@save_product');
Route::get('/list-product','App\Http\Controllers\ProductController@list_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::post('update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');