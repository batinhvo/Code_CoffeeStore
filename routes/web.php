<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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



//frontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('tim-kiem','App\Http\Controllers\HomeController@search');
Route::get('/all-product-page','App\Http\Controllers\HomeController@all_product');
Route::post('/autocomplete-ajax','App\Http\Controllers\HomeController@autocomplete_ajax');
Route::get('/lichsu/{customer_id}','App\Http\Controllers\HomeController@lichsu');
Route::get('/chitiet-lichsu/{order_id}','App\Http\Controllers\HomeController@chitiet_lichsu');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@detail_product');
Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::get('/all-comment','App\Http\Controllers\ProductController@all_comment');
Route::post('/allow-comment','App\Http\Controllers\ProductController@allow_comment');
Route::post('/reply-comment','App\Http\Controllers\ProductController@reply_comment');
Route::get('/delete-comment/{comment_id}','App\Http\Controllers\ProductController@delete_comment');


//backend
Route::get('admin','App\Http\Controllers\AdminController@index');
Route::get('dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');
Route::post('/admin_dashboard','App\Http\Controllers\AdminController@dashboard');
Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');



//Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');

Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');
Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');

//Brand Product
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');

Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');
Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');

//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');



Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');


Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');

//cart
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{row_Id}','App\Http\Controllers\CartController@delete_to_cart');
Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');

// //check out
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::post('/save-checkout','App\Http\Controllers\CheckoutController@save_checkout');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');
Route::post('/select-delivery-home','App\Http\Controllers\CheckoutController@select_delivery_home');
Route::post('/calculate-fee','App\Http\Controllers\CheckoutController@calculate_fee');
Route::get('/delete-fee','App\Http\Controllers\CheckoutController@delete_fee');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');
Route::get('/info-delivery','App\Http\Controllers\CheckoutController@info_delivery');


//order 
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/statistical','App\Http\Controllers\OrderController@statistical');
Route::get('/view-order/{order_id}','App\Http\Controllers\OrderController@view_order');
Route::get('/filter-order/{order_status}','App\Http\Controllers\OrderController@filter_order');
Route::post('/update-order-quantity','App\Http\Controllers\OrderController@update_order_quantity');




//send mail
Route::get('send-mail','App\Http\Controllers\HomeController@send_mail');

//chatbox
Route::post('chatbot','App\Http\Controllers\HomeController@chatbot');

//check-coupon
Route::post('/check-coupon','App\Http\Controllers\CheckoutController@check_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/delete-coupon-home','App\Http\Controllers\CouponController@delete_coupon_home');
Route::get('/all-coupon','App\Http\Controllers\CouponController@all_coupon');
Route::post('/save-coupon','App\Http\Controllers\CouponController@save_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
 
//delivery
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery','App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery','App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship','App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-delivery','App\Http\Controllers\DeliveryController@update_delivery');
Route::get('/all-delivery','App\Http\Controllers\DeliveryController@all_delivery');
Route::get('/edit-delivery/{fee_id}','App\Http\Controllers\DeliveryController@edit_delivery');
Route::post('/update-deliverys/{fee_id}','App\Http\Controllers\DeliveryController@update_deliverys');

//Banner
Route::get('/manage-banner','App\Http\Controllers\SliderController@manage_banner');
Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::post('/insert-slider','App\Http\Controllers\SliderController@insert_slider');
Route::get('/unactive-slider/{slider_id}','App\Http\Controllers\SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','App\Http\Controllers\SliderController@active_slider');
Route::get('/delete-slide/{slider_id}','App\Http\Controllers\SliderController@delete_slider');

//Import export
Route::post('/export-csv','App\Http\Controllers\CategoryProduct@export_csv');
Route::post('/import-csv','App\Http\Controllers\CategoryProduct@import_csv');

//Manage
Route::get('/add-manage','App\Http\Controllers\AuthController@add_manage');
Route::get('/all-manage','App\Http\Controllers\AuthController@all_manage');
Route::get('/register-auth','App\Http\Controllers\AuthController@register_auth');
Route::post('/register','App\Http\Controllers\AuthController@register');
Route::get('/delete-admin/{admin_id}','App\Http\Controllers\AuthController@delete_admin');
Route::get('/unactive-admin/{admin_id}','App\Http\Controllers\AuthController@unactive_admin');
Route::get('/active-admin/{admin_id}','App\Http\Controllers\AuthController@active_admin');

//warehouse
Route::post('/save-warehouse','App\Http\Controllers\AuthController@save_warehouse');
Route::post('/update-warehouse/{warehouse_id}','App\Http\Controllers\AuthController@update_warehouse');

Route::get('/add-warehouse','App\Http\Controllers\AuthController@add_warehouse');
Route::get('/manage-warehouse','App\Http\Controllers\AuthController@manage_warehouse');
Route::get('/edit-warehouse/{warehouse_id}','App\Http\Controllers\AuthController@edit_warehouse');
Route::get('/delete-warehouse/{warehouse_id}','App\Http\Controllers\AuthController@delete_warehouse');

//post
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/unactive-post/{post_id}','App\Http\Controllers\PostController@unactive_post');
Route::get('/active-post/{post_id}','App\Http\Controllers\PostController@active_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');

Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');

//new feed
Route::get('/add-new-feed','App\Http\Controllers\NewFeed@add_new_feed');
Route::get('/all-new-feed','App\Http\Controllers\NewFeed@all_new_feed');
Route::post('/save-new-feed','App\Http\Controllers\NewFeed@save_new_feed');
Route::get('/delete-newfeed/{post_id}','App\Http\Controllers\NewFeed@delete_newfeed');
Route::get('/unactive-newfeed/{post_id}','App\Http\Controllers\NewFeed@unactive_newfeed');
Route::get('/active-newfeed/{post_id}','App\Http\Controllers\NewFeed@active_newfeed');
Route::get('/edit-newfeed/{post_id}','App\Http\Controllers\NewFeed@edit_newfeed');
Route::post('/update-newfeed/{post_id}','App\Http\Controllers\NewFeed@update_newfeed');
Route::get('/danh-muc-bai-viet/{post_id}','App\Http\Controllers\NewFeed@show_newfeed');
Route::get('/bai-viet/{post_id}','App\Http\Controllers\NewFeed@bai_viet');

//gallery
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('/select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/deletes-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('/update-gallery','App\Http\Controllers\GalleryController@update_gallery');


