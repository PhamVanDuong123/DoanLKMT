<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductCategoryController;
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

Route::get('/', 'User\HomeController@index')->name('home');

//User
Route::group(['prefix' => '/user'], function () {
    //product
    Route::get('/product', 'User\ProductController@index')->name('product.index');
    Route::get('/product/showByCategory/{cate_id}', 'User\ProductController@showByCategory')->name('product.showByCate');
    Route::get('/product/{id}', 'User\ProductController@detail')->name('product.detail');

    //cart
    Route::get('/cart/add/{id}', 'User\CartController@add')->name('cart.add');
    Route::get('/cart/checkout/{id?}', 'User\CartController@checkout')->name('cart.checkout');

    //post
    Route::get('/post', 'User\PostController@index')->name('post.index');
    Route::get('/post/{id}', 'User\PostController@detail')->name('post.detail');

    //page
    Route::get('/page/{name}', 'User\PageController@detail')->name('page.detail');
});

//Admin
Route::middleware('auth', 'checkRoleAdmin')->prefix('/admin')->group(function () {

    Route::middleware('roleSale')->group(function () {
        //dashboard
        Route::get('/', 'Admin\DashboardController@show')->name('admin.dashboard.show');

        //order
        Route::get('/order', 'Admin\OrderController@index')->name('admin.order.index');
        Route::get('/order/search', 'Admin\OrderController@search')->name('admin.order.search');
        Route::get('/order/process/{id}', 'Admin\OrderController@process')->name('admin.order.process');
        Route::get('/order/exit/{id}', 'Admin\OrderController@exit')->name('admin.order.exit');

        //promotion
        Route::get('/promotion', 'Admin\PromotionController@index')->name('admin.promotion.index');
        Route::get('/promotion/add', 'Admin\PromotionController@add')->name('admin.promotion.add');
        Route::post('/promotion/store', 'Admin\PromotionController@store')->name('admin.promotion.store');
        Route::get('/promotion/delete/{id}', 'Admin\PromotionController@delete')->name('admin.promotion.delete');
        Route::post('/promotion/action', 'Admin\PromotionController@action')->name('admin.promotion.action');
        Route::get('/promotion/edit/{id}', 'Admin\PromotionController@edit')->name('admin.promotion.edit');
        Route::post('/promotion/update/{id}', 'Admin\PromotionController@update')->name('admin.promotion.update');
    });

    Route::middleware('roleAdmin')->group(function () {
        //users
        Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
        Route::get('/user/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
        Route::get('/user/action', 'Admin\UserController@action')->name('admin.user.action');
        Route::get('/user/editPermission/{id}', 'Admin\UserController@editPermission')->name('admin.user.editPermission');
        Route::post('/user/updatePermission/{id}', 'Admin\UserController@updatePermission')->name('admin.user.updatePermission');
        Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
        Route::post('/user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');

        //product
        Route::get('/product', 'Admin\ProductController@index')->name('admin.product.index');
        Route::get('/product/detail/{id}', 'Admin\ProductController@detail')->name('admin.product.detail');
        Route::get('/product/add', 'Admin\ProductController@add')->name('admin.product.add');
        Route::post('/product/add', 'Admin\ProductController@store')->name('admin.product.add');
        Route::get('/product/edit/{id}', 'Admin\ProductController@edit')->name('admin.product.edit');
        Route::post('/product/update/{id}', 'Admin\ProductController@update')->name('admin.product.update');
        Route::get('/product/delete/{id}', 'Admin\ProductController@delete')->name('admin.product.delete');
        Route::post('/product/action', 'Admin\ProductController@action')->name('admin.product.action');

        //product category
        Route::get('/product_category', 'Admin\ProductCategoryController@index')->name('admin.product_category.index');
        Route::get('/product_category/index', 'Admin\ProductCategoryController@index')->name('admin.product_category.index');
        Route::get('/product_category/add', 'Admin\ProductCategoryController@getadd')->name('admin.product_category.add');
        Route::post('/product_category/add', 'Admin\ProductCategoryController@postadd')->name('admin.product_category.add');
        Route::get('/product_category/deletecategory/{id}', 'Admin\ProductCategoryController@deletecategory')->name('admin.product_category.deletecategory');
        Route::post('/product_category/edit/{id}', 'Admin\ProductCategoryController@postedit')->name('admin.product_category.edit');
        Route::get('/product_category/edit/{id}', 'Admin\ProductCategoryController@getedit')->name('admin.product_category.edit');
        Route::get('/product_category/action', 'Admin\ProductCategoryController@action')->name('admin.product_category.action');


        //post
        Route::get('/post', 'Admin\PostController@index')->name('admin.post.index');
        Route::get('/post/detail/{id}', 'Admin\PostController@detail')->name('admin.post.detail');
        Route::get('/post/add', 'Admin\PostController@add')->name('admin.post.add');
        Route::post('/post/store', 'Admin\PostController@store')->name('admin.post.store');
        Route::get('/post/edit/{id}', 'Admin\PostController@edit')->name('admin.post.edit');
        Route::post('/post/update/{id}', 'Admin\PostController@update')->name('admin.post.update');
        Route::get('/post/delete/{id}', 'Admin\PostController@delete')->name('admin.post.delete');
        Route::post('/post/action', 'Admin\PostController@action')->name('admin.post.action');

        //post category
        Route::get('/postCategory', 'Admin\PostCategoryController@index')->name('admin.post_category.index');
        Route::get('/postCategory/add', 'Admin\PostCategoryController@add')->name('admin.post_category.add');
        Route::post('/postCategory/store', 'Admin\PostCategoryController@store')->name('admin.post_category.store');
        Route::get('/postCategory/edit/{id}', 'Admin\PostCategoryController@edit')->name('admin.post_category.edit');
        Route::post('/postCategory/update/{id}', 'Admin\PostCategoryController@update')->name('admin.post_category.update');
        Route::get('/postCategory/delete/{id}', 'Admin\PostCategoryController@delete')->name('admin.post_category.delete');
        Route::post('/postCategory/action', 'Admin\PostCategoryController@action')->name('admin.post_category.action');

        //brand
        Route::get('/brand', 'Admin\BrandController@index')->name('admin.brand.index');
        Route::get('/brand/detail/{id}', 'Admin\BrandController@detail')->name('admin.brand.detail');
        Route::get('/brand/add', 'Admin\BrandController@add')->name('admin.brand.add');
        Route::post('/brand/store', 'Admin\BrandController@store')->name('admin.brand.store');
        Route::get('/brand/edit/{id}', 'Admin\BrandController@edit')->name('admin.brand.edit');
        Route::post('/brand/update/{id}', 'Admin\BrandController@update')->name('admin.brand.update');
        Route::get('/brand/delete/{id}', 'Admin\BrandController@delete')->name('admin.brand.delete');
        Route::post('/brand/action', 'Admin\BrandController@action')->name('admin.brand.action');
    });
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//authen
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

//filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
