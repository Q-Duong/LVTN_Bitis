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
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InfomationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ImportOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
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
//Ajax
Route::post('change-category', 'App\Http\Controllers\ProductController@change_category');
Route::post('select-category', 'App\Http\Controllers\ProductController@select_category');
Route::post('select-product-type', 'App\Http\Controllers\ProductController@select_product_type');
Route::post('select-product', 'App\Http\Controllers\ProductController@select_product');
Route::post('select-gallery', 'App\Http\Controllers\GalleryController@select_gallery');
Route::post('update-gallery-name', 'App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('delete-gallery', 'App\Http\Controllers\GalleryController@delete_gallery');
Route::post('update-gallery', 'App\Http\Controllers\GalleryController@update_gallery');
Route::post('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::post('member/checkout', 'App\Http\Controllers\CheckoutController@member_checkout');
Route::post('filter', 'App\Http\Controllers\ProductController@filter');
Route::post('admin/logout', [AccountController::class, 'admin_logout']);
// Route::get('login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
// Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
// Route::get('/home',[AccountController::class,'home']);
Route::get('/403', function () {
    return view('403'); })->name('403');
Auth::routes();
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashBoardController::class, 'index']);
    Route::post('/get-statistics-in-month',[DashBoardController::class,'get_statistics_in_month'])->name('get-statistics-in-month');
    Route::post('/get-statistics-by-date',[DashBoardController::class,'get_statistics_by_date'])->name('get-statistics-by-date');
    //Login
    Route::get('/profile', [AccountController::class, 'admin_profile']);
    Route::get('/settings', [AccountController::class, 'admin_settings']);
    Route::post('/infoupdate', [AccountController::class, 'info_update']);
    //Category
    Route::prefix('category')->middleware('permission')->group(function () {
        Route::get('/add', [CategoryController::class, 'add_category']);
        Route::post('/save', [CategoryController::class, 'save_category']);
        Route::get('/list', [CategoryController::class, 'list_category']);
        Route::get('/edit/{category_id}', [CategoryController::class, 'edit_category']);
        Route::post('/update/{category_id}', [CategoryController::class, 'update_category']);
        Route::get('/delete/{category_id}', [CategoryController::class, 'delete_category']);
    });

    //CategoryType
    Route::prefix('category-type')->middleware('permission')->group(function () {
        Route::get('/add', [CategoryTypeController::class, 'add_category_type']);
        Route::post('/save', [CategoryTypeController::class, 'save_category_type']);
        Route::get('/list', [CategoryTypeController::class, 'list_category_type']);
        Route::get('/edit/{category_type_id}', [CategoryTypeController::class, 'edit_category_type']);
        Route::post('/update/{category_type_id}', [CategoryTypeController::class, 'update_category_type']);
        Route::get('/delete/{category_type_id}', [CategoryTypeController::class, 'delete_category_type']);
    });
    //Product
    Route::prefix('product')->middleware('permission')->group(function () {
        Route::get('/add', [ProductController::class, 'add_product']);
        Route::post('/save', [ProductController::class, 'save_product']);
        Route::get('/list', [ProductController::class, 'list_Product']);
        Route::get('/edit/{product_id}', [ProductController::class, 'edit_product']);
        Route::post('update/{product_id}', [ProductController::class, 'update_product']);
        Route::get('/delete/{product_id}', [ProductController::class, 'delete_product']);
    });
    //ProductType
    Route::prefix('product-type')->middleware('permission')->group(function () {
        Route::get('/add', [ProductTypeController::class, 'add_product_type']);
        Route::post('/save', [ProductTypeController::class, 'save_product_type']);
        Route::get('/list', [ProductTypeController::class, 'list_product_type']);
        Route::get('/edit/{product_type_id}', [ProductTypeController::class, 'edit_product_type']);
        Route::post('update/{product_type_id}', [ProductTypeController::class, 'update_product_type']);
        Route::get('/delete/{product_type_id}', [ProductTypeController::class, 'delete_product_type']);
    });
    //Banner
    Route::prefix('banner')->group(function () {
        Route::get('/list', [BannerController::class, 'list_banner']);
        Route::get('/add', [BannerController::class, 'add_banner']);
        Route::get('/delete/{banner_id}', [BannerController::class, 'delete_banner']);
        Route::get('/edit/{banner_id}', [BannerController::class, 'edit_banner']);
        Route::post('/save', [BannerController::class, 'save_banner']);
        Route::post('/update/{banner_id}', [BannerController::class, 'update_banner']);
    });
    //Gallery
    Route::prefix('gallery')->middleware('permission')->group(function () {
        Route::get('add/{product_id}', [GalleryController::class, 'add_gallery']);
        Route::post('insert/{product_id}', [GalleryController::class, 'insert_gallery']);
    });
    //User
    Route::prefix('user')->group(function () {
        Route::get('/add', [UserController::class, 'add_user']);
        Route::post('/save', [UserController::class, 'save_user']);
        Route::get('/list', [UserController::class, 'list_user']);
        Route::get('/edit/{user_id}', [UserController::class, 'edit_user']);
        Route::post('update/{user_id}', [UserController::class, 'update_user']);
        Route::get('/delete/{user_id}', [UserController::class, 'delete_user']);
    });
    //Employee
    Route::prefix('employee')->middleware('permission')->group(function () {
        Route::get('/add', [EmployeeController::class, 'add_employee']);
        Route::post('/save', [EmployeeController::class, 'save_employee']);
        Route::get('/list', [EmployeeController::class, 'list_employee']);
        Route::get('/edit/{user_id}', [EmployeeController::class, 'edit_employee']);
        Route::post('update/{user_id}', [EmployeeController::class, 'update_employee']);
        Route::get('/delete/{user_id}', [EmployeeController::class, 'delete_employee']);
    });
    // Post
    Route::prefix('post')->group(function () {
        Route::get('/add', [PostController::class, 'add_post']);
        Route::post('/save', [PostController::class, 'save_post']);
        Route::get('/list', [PostController::class, 'list_post']);
        Route::get('/edit/{post_id}', [PostController::class, 'edit_post']);
        Route::post('update/{post_id}', [PostController::class, 'update_post']);
        Route::get('/delete/{post_id}', [PostController::class, 'delete_post']);
    });
    //Category Post
    Route::prefix('category-post')->group(function () {
        Route::get('/add', [CategoryPostController::class, 'add_category_post']);
        Route::post('/save', [CategoryPostController::class, 'save_category_post']);
        Route::get('/list', [CategoryPostController::class, 'list_category_post']);
        Route::get('/edit/{category_post_id}', [CategoryPostController::class, 'edit_category_post']);
        Route::post('update/{category_post_id}', [CategoryPostController::class, 'update_category_post']);
        Route::get('/delete/{category_post_id}', [CategoryPostController::class, 'delete_category_post']);
    });
    //Color
    Route::prefix('color')->middleware('permission')->group(function () {
        Route::get('/add', [ColorController::class, 'add_color']);
        Route::post('/save', [ColorController::class, 'save_color']);
        Route::get('/list', [ColorController::class, 'list_color']);
        Route::get('/edit/{post_id}', [ColorController::class, 'edit_color']);
        Route::post('update/{color_id}', [ColorController::class, 'update_color']);
        Route::get('/delete/{color_id}', [ColorController::class, 'delete_color']);
    });
    //Size
    Route::prefix('size')->middleware('permission')->group(function () {
        Route::get('/add', [SizeController::class, 'add_size']);
        Route::post('/save', [SizeController::class, 'save_size']);
        Route::get('/list', [SizeController::class, 'list_size']);
        Route::get('/edit/{size_id}', [SizeController::class, 'edit_size']);
        Route::post('update/{size_id}', [SizeController::class, 'update_size']);
        Route::get('/delete/{size_id}', [SizeController::class, 'delete_size']);
    });
    //WareHouse
    Route::prefix('ware-house')->group(function () {
        Route::get('/add', [WareHouseController::class, 'add_ware_house']);
        Route::get('/list', [WareHouseController::class, 'list_ware_house']);
        Route::get('/edit/{ware_house_id}', [WareHouseController::class, 'edit_ware_house']);
        Route::get('/delete/{ware_house_id}', [WareHouseController::class, 'delete_ware_house']);
        Route::post('/save', [WareHouseController::class, 'save_ware_house']);
        Route::post('/update/{ware_house_id}', [WareHouseController::class, 'update_ware_house']);
    });
    //Contact
    Route::prefix('contact')->group(function () {
        Route::get('/edit/{info_id}', [InfomationController::class, 'edit_info']);
        Route::post('/update/{info_id}', [InfomationController::class, 'update_info']);
    });
    //Message
    Route::prefix('message')->group(function () {
        Route::get('/list', [MessageController::class, 'list_message']);
        Route::get('/delete/{message_id}', [MessageController::class, 'delete_message']);
    });
    //ImportOrder
    Route::prefix('import-order')->group(function () {
        Route::get('/add', [ImportOrderController::class, 'add_import_order']);
        Route::post('/save', [ImportOrderController::class, 'save_import_order'])->name('save-import-order');
        Route::get('/add/{import_order_id}', [ImportOrderController::class, 'add_import_order_detail']);
        Route::get('/update-total/{import_order_id}', [ImportOrderController::class, 'add_import_order_detail']);
        Route::post('/delete/import-order-detail', [ImportOrderController::class, 'delete_import_order_detail'])->name('delete-import-order-detail');
        Route::post('/update/import-order-detail', [ImportOrderController::class, 'update_import_order_detail'])->name('update-import-order-detail');
        Route::post('/save-import-order-detail', [ImportOrderController::class, 'save_import_order_detail'])->name('save-import-order-detail');
        Route::post('/load-import-order-detail', [ImportOrderController::class, 'load_import_order_detail'])->name('load-import-order-detail');
        Route::get('/list', [ImportOrderController::class, 'list_import_order'])->name('list-import-order');
        Route::get(
            '/edit/{import_order_id}',
            [ImportOrderController::class, 'edit_import_order']
        )->name('edit-import-order');
        Route::post('/update/{import_order_id}', [ImportOrderController::class, 'update_import_order'])->name('update-import-order');
        ;
        Route::get('/delete/{import_order_id}', [ImportOrderController::class, 'delete_import_order'])->name('delete-import-order');

    });
    //Order, Reciver
    Route::prefix('order')->group(function () {
        Route::get('/add', [OrderController::class, 'add_order']);
        Route::post('/save', [OrderController::class, 'save_order']);
        Route::get('/add/{order_id}', [OrderController::class, 'add_order_detail'])->name('add-order');
        Route::post('/save-order-detail', [OrderController::class, 'save_order_detail'])->name('save-order-detail');
        Route::post('/load-order-detail', [OrderController::class, 'load_order_detail'])->name('load-order-detail');
        Route::post('/save-order/{order_id}', [OrderController::class, 'save_order_admin'])->name('save-order-admin');
        ;
        Route::get('/list', [OrderController::class, 'list_order'])->name('list-order');
        Route::get('/edit/{order_code}', [OrderController::class, 'edit_order']);



        Route::post('update/{order_code}', [OrderController::class, 'update_order']);
        Route::get('/delete/{order_id}', [OrderController::class, 'delete_order']);
        Route::post('update-order-detail-quantity', [OrderController::class, 'update_order_detail_quantity'])->name('update-order-detail-quantity');
    });
    //Discount
    Route::prefix('discount')->middleware('permission')->group(function(){ 
        Route::get('/add',[DiscountController::class,'add_discount']);
        Route::post('/save',[DiscountController::class,'save_discount']);
        Route::get('/list',[DiscountController::class,'list_discount']);
        Route::get('/edit/{discount_id}',[DiscountController::class,'edit_discount']);
        Route::post('/update/{discount_id}',[DiscountController::class,'update_discount']);
        Route::get('/delete/{discount_id}',[DiscountController::class,'delete_discount']);
    });
});
Route::post('/save-message', 'App\Http\Controllers\MessageController@save_message');

Route::post('/search-product-admin', [ImportOrderController::class, 'search_product_admin']);

//-------------------------------------------- Frontend --------------------------------------------
//Home
Route::get('', 'App\Http\Controllers\HomeController@index');
Route::get('/wistlist', 'App\Http\Controllers\HomeController@wistlist');

//Category
Route::get('collections/{category_slug}', 'App\Http\Controllers\CategoryController@show_category_details');
Route::get('collections/discount', 'App\Http\Controllers\CategoryController@show_category_discount');
//ProductType
Route::get('collections/{category_slug}/{product_type_slug}', 'App\Http\Controllers\ProductTypeController@show_product_type_details');
Route::get('collections/discount/{discount_slug}', 'App\Http\Controllers\CategoryController@show_discount_details');
//CategoryPost
Route::get('blogs/{category_post_slug}', 'App\Http\Controllers\CategoryPostController@show_category_post');

//Product
Route::get('products/{product_slug}', 'App\Http\Controllers\ProductController@show_product_details');
Route::post('get-ware-house-id', 'App\Http\Controllers\ProductController@get_ware_house_id');
Route::post('check-quantity-cart', 'App\Http\Controllers\ProductController@check_quantity_cart');

//Post 
Route::get('blog/{post_slug}', 'App\Http\Controllers\PostController@show_post');

//Login
Route::prefix('member')->group(function () {
    Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('member/login');
    Route::get('/register', 'App\Http\Controllers\LoginController@register');
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout_checkout');
    Route::post('/login-submit', 'App\Http\Controllers\LoginController@login_submit');
    Route::post('/save-user-fe', 'App\Http\Controllers\LoginController@save_user_FE');

    Route::group(['middleware' => 'isMember'], function () {
        Route::get('/profile', 'App\Http\Controllers\LoginController@profile');
        Route::get('/settings', 'App\Http\Controllers\LoginController@settings');
        Route::post('/update-profile', 'App\Http\Controllers\LoginController@update_profile');
        Route::get('/settings/delivery-addresses', 'App\Http\Controllers\LoginController@delivery_addresses');
        Route::get('/orders', 'App\Http\Controllers\LoginController@orders');
        Route::get('/orders/order-detail/{order_code}', 'App\Http\Controllers\LoginController@order_detail');
    });
});

//Rating
Route::post('member/send-comment', 'App\Http\Controllers\CommentController@send_comment');
Route::post('add-rating', 'App\Http\Controllers\CommentController@add_rating');
//Contact
Route::get('/contact', 'App\Http\Controllers\InfomationController@show_Info');

//Cart
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/cart', 'App\Http\Controllers\CartController@cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/del-product/{session_id}', 'App\Http\Controllers\CartController@delete_product');
Route::get('/count-cart-products', 'App\Http\Controllers\CartController@count_cart_products');

//Checkout
Route::post('/select-address', 'App\Http\Controllers\CheckoutController@select_address');
Route::post('/save-checkout-information', 'App\Http\Controllers\CheckoutController@save_checkout_information');
Route::get('/checkout/{order_code}', 'App\Http\Controllers\CheckoutController@checkout_step_1');
Route::get('/payment/{order_code}', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/payment-method', 'App\Http\Controllers\CheckoutController@payment_method');
Route::get('/handcash', 'App\Http\Controllers\CheckoutController@handcash');
Route::get('/query-transaction', 'App\Http\Controllers\CheckoutController@query_transaction');

//Search
Route::post('/search-autocomplete','App\Http\Controllers\HomeController@search_autocomplete');
Route::post('/search','App\Http\Controllers\HomeController@search');

Route::post('/save-delivery-addresses','App\Http\Controllers\LoginController@save_delivery_addresses');
Route::post('/update-delivery-addresses/{delivery_id}','App\Http\Controllers\LoginController@update_delivery_addresses');
Route::get('test-momo','App\Http\Controllers\CheckoutController@momotest');
