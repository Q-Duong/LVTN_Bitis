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
Route::post('update-category/{category_id}','App\Http\Controllers\CategoryController@update_category');
Route::get('/delete-category/{category_id}','App\Http\Controllers\CategoryController@delete_category');
//CategoryType
Route::get('/add-category-type','App\Http\Controllers\CategoryTypeController@add_category_type');
Route::post('save-category-type','App\Http\Controllers\CategoryTypeController@save_category_type');
Route::get('/list-category-type','App\Http\Controllers\CategoryTypeController@list_category_type');
Route::get('/edit-category-type/{category_type_id}','App\Http\Controllers\CategoryTypeController@edit_category_type');
Route::post('update-category-type/{category_type_id}','App\Http\Controllers\CategoryTypeController@update_category_type');
Route::get('/delete-category-type/{category_type_id}','App\Http\Controllers\CategoryTypeController@delete_category_type');
//ProductType
Route::get('/add-product-type','App\Http\Controllers\ProductTypeController@add_product_type');
Route::post('/save-product-type','App\Http\Controllers\ProductTypeController@save_product_type');
Route::get('/list-product-type','App\Http\Controllers\ProductTypeController@list_product_type');
Route::get('/edit-product-type/{product_type_id}','App\Http\Controllers\ProductTypeController@edit_product_type');
Route::post('update-product-type/{product_type_id}','App\Http\Controllers\ProductTypeController@update_product_type');
Route::get('/delete-product-type/{product_type_id}','App\Http\Controllers\ProductTypeController@delete_product_type');
//Route::update('/update-product-type','App\Http\Controllers\ProductController@update_product_type');
