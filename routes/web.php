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

//Banner
Route::get('/list-banner','App\Http\Controllers\BannerController@list_banner');
Route::get('/add-banner','App\Http\Controllers\BannerController@add_banner');
Route::get('/delete-banner/{banner_id}','App\Http\Controllers\BannerController@delete_banner');
Route::get('/edit-banner/{banner_id}','App\Http\Controllers\BannerController@edit_banner');
Route::post('/save-banner','App\Http\Controllers\BannerController@save_banner');
Route::post('/update-banner/{banner_id}','App\Http\Controllers\BannerController@update_banner');
//Route::update('/update-product-type','App\Http\Controllers\ProductController@update_product_type');

//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::get('/list-product','App\Http\Controllers\ProductController@list_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::post('update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::post('select-category','App\Http\Controllers\ProductController@select_category');

//Gallery
Route::get('add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('insert-gallery/{product_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('update-gallery','App\Http\Controllers\GalleryController@update_gallery');

//User
Route::get('/add-user-admin','App\Http\Controllers\UserController@add_user');
Route::post('/save-user','App\Http\Controllers\UserController@save_user');
Route::get('/list-user','App\Http\Controllers\UserController@list_user');
Route::get('/edit-user/{user_id}','App\Http\Controllers\UserController@edit_user');
Route::post('update-user/{user_id}','App\Http\Controllers\UserController@update_user');
Route::get('/delete-user/{user_id}','App\Http\Controllers\UserController@delete_user');

//Employee
Route::get('/add-employee','App\Http\Controllers\EmployeeController@add_employee');
Route::post('/save-employee','App\Http\Controllers\EmployeeController@save_employee');
Route::get('/list-employee','App\Http\Controllers\EmployeeController@list_employee');
Route::get('/edit-employee/{employee_id}','App\Http\Controllers\EmployeeController@edit_employee');
Route::post('update-employee/{employee_id}','App\Http\Controllers\EmployeeController@update_employee');
Route::get('/delete-employee/{employee_id}','App\Http\Controllers\EmployeeController@delete_employee');

//Category Post
Route::get('/add-category-post','App\Http\Controllers\CategoryPostController@add_category_post');
Route::post('/save-category-post','App\Http\Controllers\CategoryPostController@save_category_post');
Route::get('/list-category-post','App\Http\Controllers\CategoryPostController@list_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@edit_category_post');
Route::post('update-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@update_category_post');
Route::get('/delete-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@delete_category_post');

// Post
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::get('/list-post','App\Http\Controllers\PostController@list_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::post('update-post/{post_id}','App\Http\Controllers\PostController@update_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');
//-------------------------------------------- Frontend --------------------------------------------
//Home
Route::get('','App\Http\Controllers\HomeController@index');

//Category
Route::get('collections/{category_slug}','App\Http\Controllers\CategoryController@show_category_details');

//ProductType
Route::get('collections/{category_slug}/{product_type_slug}','App\Http\Controllers\ProductTypeController@show_product_type_details');

//Category
Route::get('blogs/{category_post_slug}','App\Http\Controllers\CategoryPostController@show_category_post');

//Login
Route::get('/login','App\Http\Controllers\LoginController@login');
Route::get('/register','App\Http\Controllers\LoginController@register');
Route::get('/logout-checkout','App\Http\Controllers\LoginController@logout_checkout');
Route::post('/login-submit','App\Http\Controllers\LoginController@login_submit');
Route::post('/save-user','App\Http\Controllers\LoginController@save_user');




