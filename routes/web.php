<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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
Route::post('update-category','App\Http\Controllers\CategoryController@update_category');
Route::get('/delete-category/{category_id}','App\Http\Controllers\CategoryController@delete_category');
Route::get('/add-category-type','App\Http\Controllers\CategoryController@add_category_type');
Route::post('save-category-type','App\Http\Controllers\CategoryController@save_category_type');

Route::get('/add-product-type','App\Http\Controllers\ProductController@add_product_type');
Route::post('/save-product-type','App\Http\Controllers\ProductController@save_product_type');
Route::get('/list-product-type','App\Http\Controllers\ProductController@list_product_type');
Route::get('/edit-product-type/{product_type_id}','App\Http\Controllers\ProductController@edit_product_type');
Route::post('update-product-type/{product_type_id}','App\Http\Controllers\ProductController@update_product_type');
Route::get('/delete-product-type/{product_type_id}','App\Http\Controllers\ProductController@delete_product_type');
//Route::update('/update-product-type','App\Http\Controllers\ProductController@update_product_type');
