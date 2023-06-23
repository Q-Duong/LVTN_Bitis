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
Route::post('select-product-type','App\Http\Controllers\ProductController@select_product_type');

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

//Color
Route::get('/add-color','App\Http\Controllers\ColorController@add_color');
Route::post('/save-color','App\Http\Controllers\ColorController@save_color');
Route::get('/list-color','App\Http\Controllers\ColorController@list_color');
Route::get('/edit-color/{post_id}','App\Http\Controllers\ColorController@edit_color');
Route::post('update-color/{color_id}','App\Http\Controllers\ColorController@update_color');
Route::get('/delete-color/{color_id}','App\Http\Controllers\ColorController@delete_color');


//Size
Route::get('/add-size','App\Http\Controllers\SizeController@add_size');
Route::post('/save-size','App\Http\Controllers\SizeController@save_size');
Route::get('/list-size','App\Http\Controllers\SizeController@list_size');
Route::get('/edit-size/{size_id}','App\Http\Controllers\SizeController@edit_size');
Route::post('update-size/{size_id}','App\Http\Controllers\SizeController@update_size');
Route::get('/delete-size/{size_id}','App\Http\Controllers\SizeController@delete_size');

//WareHouse
Route::get('/add-ware-house','App\Http\Controllers\WareHouseController@add_ware_house');
Route::get('/list-ware-house','App\Http\Controllers\WareHouseController@list_ware_house');
Route::get('/edit-ware-house/{product_id}','App\Http\Controllers\WareHouseController@edit_ware_house');
Route::get('/delete-ware-house/{ware_house_id}','App\Http\Controllers\WareHouseController@delete_ware_house');
Route::post('/save-ware-house','App\Http\Controllers\WareHouseController@save_ware_house');
Route::post('/update-ware-house/{ware_house_id}','App\Http\Controllers\WareHouseController@update_ware_house');
//Store
Route::get('/add-store','App\Http\Controllers\StoreController@add_store');
Route::get('/list-store','App\Http\Controllers\StoreController@list_store');
Route::get('/edit-store/{store_id}','App\Http\Controllers\StoreController@edit_store');
Route::get('/delete-store/{store_id}','App\Http\Controllers\StoreController@delete_store');
Route::post('/save-store','App\Http\Controllers\StoreController@save_store');
Route::post('/update-store/{store_id}','App\Http\Controllers\StoreController@update_store');

//Contact
Route::get('/edit-info/{info_id}','App\Http\Controllers\InfomationController@edit_info');
Route::post('/update-info/{info_id}','App\Http\Controllers\InfomationController@update_info');

//Message
Route::get('/list-message','App\Http\Controllers\MessageController@list_message');
Route::post('/save-message','App\Http\Controllers\MessageController@save_message');
Route::get('/delete-message/{message_id}','App\Http\Controllers\MessageController@delete_message');

//ImportOrder
Route::get('/add-import-order','App\Http\Controllers\ImportOrderController@add_import_order');
Route::get('/list-import-order','App\Http\Controllers\ImportOrderController@list_import_order');
Route::get('/edit-import-order/{import_order_id}','App\Http\Controllers\ImportOrderController@edit_import_order');
Route::get('/delete-import-order/{import_order_id}','App\Http\Controllers\ImportOrderController@delete_import_order');
Route::post('/save-import-order','App\Http\Controllers\ImportOrderController@save_import_order');
Route::post('/update-import-order/{import_order_id}','App\Http\Controllers\ImportOrderController@update_import_order');

//Order
Route::get('/add-order','App\Http\Controllers\OrderController@add_order');
Route::post('/save-order','App\Http\Controllers\OrderController@save_order');
Route::get('/list-order','App\Http\Controllers\OrderController@list_order');
Route::get('/edit-order/{product_id}','App\Http\Controllers\OrderController@edit_order');
Route::post('update-order/{product_id}','App\Http\Controllers\OrderController@update_order');
Route::get('/delete-order/{product_id}','App\Http\Controllers\OrderController@delete_order');


//-------------------------------------------- Frontend --------------------------------------------
//Home
Route::get('','App\Http\Controllers\HomeController@index');
Route::get('/wistlist','App\Http\Controllers\HomeController@wistlist');

//Category
Route::get('collections/{category_slug}','App\Http\Controllers\CategoryController@show_category_details');

//ProductType
Route::get('collections/{category_slug}/{product_type_slug}','App\Http\Controllers\ProductTypeController@show_product_type_details');

//CategoryPost
Route::get('blogs/{category_post_slug}','App\Http\Controllers\CategoryPostController@show_category_post');

//Product
Route::get('products/{product_slug}','App\Http\Controllers\ProductController@show_product_details');
Route::post('get-ware-house-id','App\Http\Controllers\ProductController@get_ware_house_id');
Route::post('size-filter','App\Http\Controllers\ProductController@size_filter');

//Post 
Route::get('blog/{post_slug}','App\Http\Controllers\PostController@show_post');

//Login
Route::get('/login','App\Http\Controllers\LoginController@login');
Route::get('/register','App\Http\Controllers\LoginController@register');
Route::get('/logout-checkout','App\Http\Controllers\LoginController@logout_checkout');
Route::post('/login-submit','App\Http\Controllers\LoginController@login_submit');
Route::post('/save-user-fe','App\Http\Controllers\LoginController@save_user_FE');

//Contact
Route::get('/contact','App\Http\Controllers\InfomationController@show_Info');

//Cart
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::get('/cart','App\Http\Controllers\CartController@cart');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@delete_product');
Route::get('/count-cart-products','App\Http\Controllers\CartController@count_cart_products');

//Checkout


Route::post('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::post('/select-address','App\Http\Controllers\CheckoutController@select_address');
Route::post('/save-checkout-information','App\Http\Controllers\CheckoutController@save_checkout_information');
Route::get('/checkout/{order_code}','App\Http\Controllers\CheckoutController@checkout_step_1');
Route::get('/payment/{order_code}','App\Http\Controllers\CheckoutController@payment');
Route::post('/payment-method','App\Http\Controllers\CheckoutController@payment_method');
Route::get('/handcash','App\Http\Controllers\CheckoutController@handcash');


