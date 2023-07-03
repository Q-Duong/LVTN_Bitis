<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Auth;


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



    // Route::get('/',[AccountController::class,'index']);
    // Route::post('/login',[AccountController::class,'admin_login']);
 //Ajax
Route::post('select-category','App\Http\Controllers\ProductController@select_category');
Route::post('select-product-type','App\Http\Controllers\ProductController@select_product_type');
Route::post('select-product','App\Http\Controllers\ProductController@select_product');
Route::post('select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('update-gallery','App\Http\Controllers\GalleryController@update_gallery');

Route::prefix('admin')->middleware('auth')->group(function(){
    // Route::get('/',[AccountController::class,'index']);
    // Route::post('/login',[AccountController::class,'admin_login']);
    Route::get('/dashboard',[AccountController::class,'dashboard']);


    //Category
    Route::prefix('category')->group(function(){
        Route::get('/add',[CategoryController::class,'add_category']);
        Route::post('save',[CategoryController::class,'save_category']);
        Route::get('/list',[CategoryController::class,'list_category']);
        Route::get('/edit/{category_id}',[CategoryController::class,'edit_category']);
        Route::post('update/{category_id}',[CategoryController::class,'update_category']);
        Route::get('/delete/{category_id}',[CategoryController::class,'delete_category']);
    });

    //CategoryType
    Route::prefix('category-type')->group(function(){
        Route::get('/add',[CategoryTypeController::class,'add_category_type']);
        Route::post('save',[CategoryTypeController::class,'save_category_type']);
        Route::get('/list',[CategoryTypeController::class,'list_category_type']);
        Route::get('/edit/{category_type_id}',[CategoryTypeController::class,'edit_category_type']);
        Route::post('update/{category_type_id}',[CategoryTypeController::class,'update_category_type']);
        Route::get('/delete/{category_type_id}',[CategoryTypeController::class,'delete_category_type']);
    });
    //Product
    Route::prefix('product')->group(function(){
        Route::get('/add',[ProductController::class,'add_product']);
        Route::post('/save',[ProductController::class,'save_product']);
        Route::get('/list',[ProductController::class,'list_Product']);
        Route::get('/edit/{product_id}',[ProductController::class,'edit_product']);
        Route::post('update/{product_id}',[ProductController::class,'update_product']);
        Route::get('/delete/{product_id}',[ProductController::class,'delete_product']);   
    });
    //ProductType
    Route::prefix('product-type')->group(function(){
        Route::get('/add',[ProductTypeController::class,'add_product_type']);
        Route::post('/save',[ProductTypeController::class,'save_product_type']);
        Route::get('/list',[ProductTypeController::class,'list_product_type']);
        Route::get('/edit/{product_type_id}',[ProductTypeController::class,'edit_product_type']);
        Route::post('update/{product_type_id}',[ProductTypeController::class,'update_product_type']);
        Route::get('/delete/{product_type_id}',[ProductTypeController::class,'delete_product_type']);
    });
    //Banner
    Route::prefix('banner')->group(function(){ 
        Route::get('/list',[BannerController::class,'list_banner']);
        Route::get('/add',[BannerController::class,'add_banner']);
        Route::get('/delete/{banner_id}',[BannerController::class,'delete_banner']);
        Route::get('/edit/{banner_id}',[BannerController::class,'edit_banner']);
        Route::post('/save',[BannerController::class,'save_banner']);
        Route::post('/update/{banner_id}',[BannerController::class,'update_banner']);
    });
    //Gallery
    Route::prefix('gallery')->group(function(){
        Route::get('add/{product_id}',[GalleryController::class,'add_gallery']);
        Route::post('insert/{product_id}',[GalleryController::class,'insert_gallery']);
    });
    //User
    Route::prefix('user')->group(function(){
        Route::get('/add',[UserController::class,'add_user']);
        Route::post('/save',[UserController::class,'save_user']);
        Route::get('/list',[UserController::class,'list_user']);
        Route::get('/edit/{user_id}',[UserController::class,'edit_user']);
        Route::post('update/{user_id}',[UserController::class,'update_user']);
        Route::get('/delete/{user_id}',[UserController::class,'delete_user']);
    });
    //Employee
    Route::prefix('employee')->group(function(){ 
        Route::get('/add',[EmployeeController::class,'add_employee']);
        Route::post('/save',[EmployeeController::class,'save_employee']);
        Route::get('/list',[EmployeeController::class,'list_employee']);
        Route::get('/edit/{employee_id}',[EmployeeController::class,'edit_employee']);
        Route::post('update/{employee_id}',[EmployeeController::class,'update_employee']);
        Route::get('/delete/{employee_id}',[EmployeeController::class,'delete_employee']);
    });
    // Post
    Route::prefix('post')->group(function(){ 
        Route::get('/add',[PostController::class,'add_post']);
        Route::post('/save',[PostController::class,'save_post']);
        Route::get('/list',[PostController::class,'list_post']);
        Route::get('/edit/{post_id}',[PostController::class,'edit_post']);
        Route::post('update/{post_id}',[PostController::class,'update_post']);
        Route::get('/delete/{post_id}',[PostController::class,'delete_post']);
    });

});




//Category Post
Route::get('/add-category-post','App\Http\Controllers\CategoryPostController@add_category_post');
Route::post('/save-category-post','App\Http\Controllers\CategoryPostController@save_category_post');
Route::get('/list-category-post','App\Http\Controllers\CategoryPostController@list_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@edit_category_post');
Route::post('update-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@update_category_post');
Route::get('/delete-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@delete_category_post');



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
Route::get('/edit-ware-house/{ware_house_id}','App\Http\Controllers\WareHouseController@edit_ware_house');
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

//Order, Reciver
Route::get('/add-order','App\Http\Controllers\OrderController@add_order');
Route::post('/save-order','App\Http\Controllers\OrderController@save_order');
Route::get('/list-order','App\Http\Controllers\OrderController@list_order');
Route::get('/edit-order/{order_id}','App\Http\Controllers\OrderController@edit_order');
Route::post('update-order/{order_id}','App\Http\Controllers\OrderController@update_order');
Route::get('/delete-order/{order_id}','App\Http\Controllers\OrderController@delete_order');



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
Route::post('filter','App\Http\Controllers\ProductController@filter');

//Post 
Route::get('blog/{post_slug}','App\Http\Controllers\PostController@show_post');

//Login
Route::get('/login','App\Http\Controllers\LoginController@login');
// Route::get('/register','App\Http\Controllers\LoginController@register');
Route::get('/logout-checkout','App\Http\Controllers\LoginController@logout_checkout');
Route::post('/login-submit','App\Http\Controllers\LoginController@login_submit');
Route::post('/save-user-fe','App\Http\Controllers\LoginController@save_user_FE');
// Route::get('/member/profile/{user_id}','App\Http\Controllers\LoginController@check_profile');
Route::get('/member/profile','App\Http\Controllers\LoginController@profile');
Route::get('/member/settings','App\Http\Controllers\LoginController@settings');
Route::post('/update-account-infomation/{user_id}','App\Http\Controllers\LoginController@update_account_information');
Route::get('/member/settings/delivery-addresses','App\Http\Controllers\LoginController@delivery_addresses');
Route::get('/orders','App\Http\Controllers\LoginController@orders');
Route::get('/orders/order-detail/{order_code}','App\Http\Controllers\LoginController@order_detail');

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
Route::get('/query-transaction','App\Http\Controllers\CheckoutController@query_transaction');

//Search
Route::post('/search-autocomplete','App\Http\Controllers\HomeController@search_autocomplete');
Route::post('/search','App\Http\Controllers\HomeController@search');



Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user-info', 'UserController@getUserInfo');
});

Auth::routes();

//  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');