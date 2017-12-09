<?php

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
//language change
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'languageController@switchLang']);
//language change
/*Front End Part*/
Route::get('/','HomeController@index');
Route::match(['get','post'],'/test','TestController@index');
Route::match(['post','get'],'/customer-signup','HomeController@customer_signup')->middleware('user_login');
Route::match(['post','get'],'/seller-signup','HomeController@seller_signup')->middleware('user_login');
Route::match(['post','get'],'/login','HomeController@login')->middleware('user_login');
Route::match(['post','get'],'/forget-password','HomeController@forget_password')->middleware('user_login');
Route::match(['post','get'],'/reset-password/{id}','HomeController@reset_password')->middleware('user_login');
Route::get('/logout','HomeController@logout');
Route::get('/success','HomeController@message');
Route::get('/verification/{key}','HomeController@activate');
Route::get('/get-state','UserController@get_state');
Route::match(['get','post'],'/search/{any1?}/{any2?}','searchController@index');
Route::get('/autocomplete-search','searchController@autocomplete_search');

Route::match(['post','get'],'/add-to-favorite','searchController@add_to_favorite');

Route::get('/dashboard','UserController@index')->middleware('user_logout');
Route::match(['get','post'],'/change-password','UserController@change_password')->middleware('user_logout');
Route::match(['get','post'],'/edit-profile','UserController@edit_profile')->middleware('user_logout');
Route::match(['get','post'],'/seller-edit','UserController@seller_edit')->middleware('user_logout');
Route::match(['get','post'],'/buyer-edit','UserController@buyer_edit')->middleware('user_logout');
Route::get('/my-wish-list','UserController@wish_list')->middleware('user_logout');
Route::get('/shopping-cart','UserController@shopping_cart')->middleware('user_logout');
Route::post('/delete-cart','UserController@delete_cart')->middleware('user_logout');
Route::post('/delete-wish-list','UserController@wish_list_delete')->middleware('user_logout');
Route::get('/address-book','UserController@address_book_list')->middleware('user_logout');
Route::match(['get','post'],'/add-address','UserController@add_address')->middleware('user_logout');
Route::match(['get','post'],'/edit-address/{id}','UserController@edit_address')->middleware('user_logout');
Route::get('/delete-address/{id}','UserController@delete_address')->middleware('user_logout');
Route::match(['get','post'],'/seller-store','UserController@seller_store')->middleware('user_logout');
Route::match(['get','post'],'/seller-store-edit/{id}','UserController@seller_store_edit')->middleware('user_logout');
Route::get('/delete-store/{id}','UserController@store_delete')->middleware('user_logout');
Route::get('/profile/{slug}','UserController@seller_profile')->middleware('user_logout');

Route::match(['get','post'],'/add-product','ProductController@index')->middleware('user_logout');
Route::match(['get','post'],'/edit-product/{id}','ProductController@edit_product')->middleware('user_logout');
Route::get('/delete-image/{id}','ProductController@delete_image')->middleware('user_logout');
Route::get('/product-status/{id}','ProductController@product_status')->middleware('user_logout');
Route::get('/product/{slug}','ProductController@product_details');
Route::post('/product-review','ProductController@product_review')->middleware('user_logout');

Route::get('/my-product','ProductController@my_product')->middleware('user_logout');
Route::post('/add-to-cart','ProductController@add_to_cart')->middleware('user_logout');
Route::post('/fetch-option/','ProductController@fetch_option')->middleware('user_logout');
Route::get('/get-subcat','ProductController@sub_category');

/*Front End Part*/
/*Admin Part*/
Route::get('/admin',function(){	return view('admin.admin_login');})->middleware('admin_logout');
Route::post('admin-login','admin\HomeController@login');
Route::get('admin-logout','admin\HomeController@logout');
Route::get('/admin-dashboard','admin\HomeController@dashboard')->middleware('admin_login');
Route::match(['post','get'],'/admin-change-password','admin\HomeController@change_password')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-category-list','admin\CategoryController@index')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-add-category','admin\CategoryController@add_category')->middleware('admin_login');
Route::post('/admin-previous-category-display-order','admin\CategoryController@admin_previous_category_display_order')->middleware('admin_login');

Route::match(['get', 'post'],'/admin-edit-category/{id}','admin\CategoryController@edit_category')->middleware('admin_login');
Route::get('/admin-category-status/{id}','admin\CategoryController@category_status')->middleware('admin_login');
Route::post('/admin-multi-category-change-status/','admin\CategoryController@admin_multi_category_change_status')->middleware('admin_login');
Route::get('/admin-category-delete/{id}','admin\CategoryController@delete_category')->middleware('admin_login');
Route::get('/admin-get-subcat','admin\CategoryController@sub_category');
Route::match(['get', 'post'],'/admin-delivery-staff-list','admin\UserController@delivery_staff')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-add-delivery-staff','admin\UserController@add_staff')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-edit-delivery-staff/{id}','admin\UserController@edit_staff')->middleware('admin_login');
Route::match(['get', 'post'],'/ajax-email','admin\UserController@ajax_email');
Route::post('/ajax-email1','admin\UserController@ajax_email1');
Route::get('/admin-staff-status/{id}','admin\UserController@deliverystaff_status')->middleware('admin_login');
Route::post('/admin-multi-delivery-staff-change-status/','admin\UserController@admin_multi_delivery_staff_change_status')->middleware('admin_login');
Route::get('/admin-staff-delete/{id}','admin\UserController@deliverystaff_delete')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-customers-list','admin\UserController@customers_list')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-sellers-list','admin\UserController@sellers_list')->middleware('admin_login');
Route::get('/admin-customer-status/{id}','admin\UserController@customer_status')->middleware('admin_login');
Route::get('/admin-seller-status/{id}','admin\UserController@seller_status')->middleware('admin_login');
Route::get('/admin-seller-approve/{id}','admin\UserController@seller_approve')->middleware('admin_login');
Route::get('/admin-customer-details/{id}','admin\UserController@customer_details')->middleware('admin_login');
Route::get('/admin-seller-details/{id}','admin\UserController@seller_details')->middleware('admin_login');
Route::get('/admin-customer-delete/{id}','admin\UserController@customer_delete')->middleware('admin_login');
Route::get('/admin-seller-delete/{id}','admin\UserController@seller_delete')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-product-list','admin\ProductController@index')->middleware('admin_login');
Route::get('/admin-product-status/{id}','admin\ProductController@product_status')->middleware('admin_login');
Route::post('/admin-multi-product-change-status','admin\ProductController@admin_multi_product_change_status')->middleware('admin_login');
Route::get('/admin-product-approve/{id}','admin\ProductController@admin_product_approve')->middleware('admin_login');
Route::get('/admin-product-details/{id}','admin\ProductController@product_details')->middleware('admin_login');

Route::get('/admin-product-option-delete/{id}','admin\ProductController@product_option_delete')->middleware('admin_login');
Route::get('/admin-seller-products/{id}','admin\ProductController@seller_products')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-product-option-list','admin\ProductController@product_option_list')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-add-product-option','admin\ProductController@add_product_option')->middleware('admin_login');
Route::match(['get', 'post'],'/admin-edit-product-option/{id}','admin\ProductController@edit_product_option')->middleware('admin_login');
Route::post('/fetch-option-value','admin\ProductController@option_value')->middleware('admin_login');
Route::post('/admin-product-option-value','admin\ProductController@add_option_value')->middleware('admin_login');
Route::post('/admin-product-option-edit','admin\ProductController@edit_option_value')->middleware('admin_login');
Route::post('/admin-product-option-value-update','admin\ProductController@update_option_value')->middleware('admin_login');
Route::post('/admin-product-option-delete','admin\ProductController@delete_option_value')->middleware('admin_login');
Route::post('/admin-change-multi-seller-status','admin\UserController@admin_change_multi_seller_status')->middleware('admin_login');
Route::post('/admin-change-multi-customer-status','admin\UserController@admin_change_multi_customer_status')->middleware('admin_login');
/*Admin Part*/
