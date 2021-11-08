<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\User\HomeController;

use Illuminate\Support\Facades\Session;


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
Route::post('/autocomplete-ajax','User\HomeController@autocomplete_ajax')->name('autocomplete-ajax');
Route::post('/search', 'User\HomeController@search')->name('search');
route::get('user/account/login/login_facebook/{provider}', 'SocialController@login_facebook');
Route::get('user/account/login/callback/{provider}', 'SocialController@callback');
//User
Route::group(['prefix' => '/user'], function () {
    //product
    Route::get('/product', 'User\ProductController@index')->name('product.index');
    Route::get('/product/showByCategory/{cate_id}', 'User\ProductController@showByCategory')->name('product.showByCate');
    Route::get('/product/{id}', 'User\ProductController@detail')->name('product.detail');
    Route::post('/insert-rating','User\ProductController@insert_rating');


    //cart
    Route::get('/cart/show','User\CartController@show')->name('cart.show');
    Route::get('/cart/add/{id}', 'User\CartController@add')->name('cart.add')->middleware('checkLogin');
    Route::get('/cart/remove/{rowId}', 'User\CartController@remove')->name('cart.remove');
    Route::get('/cart/destroy','User\CartController@destroy')->name('cart.destroy');
    Route::post('/cart/update','User\CartController@update')->name('cart.update');
    Route::get('/cart/checkout/{id?}', 'User\CartController@checkout')->name('cart.checkout');
    Route::post('/cart/pay', 'User\CartController@pay')->name('cart.pay');

    //post
    Route::get('/post', 'User\PostController@index')->name('post.index');
    Route::get('/post/{id}', 'User\PostController@detail')->name('post.detail');

    //page
    Route::get('/page/{name}', 'User\PageController@detail')->name('page.detail');
    // account
  
    Route::get('/account/login','User\HomeController@get_Login')->name('account.login');
    Route::post('/account/login','User\HomeController@post_Login')->name('account.login');
    Route::get('/account/logout','User\HomeController@logout')->name('account.logout');
    Route::get('/account/signup','User\HomeController@get_signup')->name('account.signup');
    Route::post('/account/signup','User\HomeController@post_signup')->name('account.signup');
    Route::get('/account/detail','User\HomeController@detail')->name('account.detail');
    Route::post('/account/detail','User\HomeController@account_detail')->name('account.detail');
    
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
        Route::get('/promotion/detail/{id}', 'Admin\PromotionController@detail')->name('admin.promotion.detail');

        //statistics
        Route::get('/statistics/sale', 'Admin\StatisticsController@sale')->name('admin.statistics.sale');
        Route::post('/fillter_by_date', 'Admin\StatisticsController@fillter_by_date')->name('admin.statistics.fillter_by_date');
        Route::post('/fillter_by_select', 'Admin\StatisticsController@fillter_by_select')->name('admin.statistics.fillter_by_select');
        Route::post('/statistical_30day', 'Admin\StatisticsController@statistical_30day')->name('admin.statistics.statistical_30day');
        Route::get('/statistics/product_post', 'Admin\StatisticsController@product_post')->name('admin.statistics.product_post');
    });

    Route::middleware('roleAdmin')->group(function () {
        //users
        Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
        Route::get('/user/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
        Route::get('/user/action', 'Admin\UserController@action')->name('admin.user.action');
        Route::get('/user/editAdmin/{id}', 'Admin\UserController@editAdmin')->name('admin.user.editAdmin');
        Route::post('/user/updateAdmin/{id}', 'Admin\UserController@updateAdmin')->name('admin.user.updateAdmin');
        Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
        Route::post('/user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');
        Route::get('/user/detail/{id}', 'Admin\UserController@detail')->name('admin.user.detail');

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
        Route::get('/product_category/detail/{id}', 'Admin\ProductCategoryController@detail')->name('admin.product_category.detail');
        Route::get('/product_category/index', 'Admin\ProductCategoryController@index')->name('admin.product_category.index');
        Route::get('/product_category/add', 'Admin\ProductCategoryController@add')->name('admin.product_category.add');
        Route::post('/product_category/add', 'Admin\ProductCategoryController@store')->name('admin.product_category.add');
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
        Route::get('/postCategory/detail/{id}', 'Admin\PostCategoryController@detail')->name('admin.post_category.detail');

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
//locate
Route::group(['middleware' => ['web']], function ()
{
    Route::get('/lang/{locale}',function($locale)
    {
        if(! in_array($locale,['vi','en','cn']))
        {
            abort(404);
        }
      
        session()->put('locate',$locale);
        return redirect()->back();
    
    });
});

