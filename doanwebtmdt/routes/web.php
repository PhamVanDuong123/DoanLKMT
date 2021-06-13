<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserHomeController;

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

// Route::get('/', function () {
//     return view('index');
// })->name('home');
//Route::get('/', [User\HomeController::class, 'index'])->name('home');
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
Route::middleware('auth')->prefix('/admin')->group(function () {
    //dashboard
    Route::get('/', 'Admin\DashboardController@show')->name('admin.dashboard.show');

    //users
    Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
    Route::get('/user/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
    Route::get('/user/action', 'Admin\UserController@action')->name('admin.user.action');
    Route::get('/user/editPermission/{id}', 'Admin\UserController@editPermission')->name('admin.user.editPermission');
    Route::post('/user/updatePermission/{id}', 'Admin\UserController@updatePermission')->name('admin.user.updatePermission');
    Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
    Route::post('/user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');

    //order

    //product
    Route::get('/product', 'AdminProductController@index')->name('admin.product.index');
    Route::get('/product/add', 'AdminProductController@add')->name('admin.product.add');
    Route::post('/product/store', 'AdminProductController@store')->name('admin.product.store');
    Route::get('/product/edit', 'AdminProductController@edit')->name('admin.product.edit');
    
    //product category

    //post
    Route::get('/post', 'AdminPostController@index')->name('admin.post.index');
    Route::get('/post/add', 'AdminPostController@add')->name('admin.post.add');

    //post category

    //brand
    Route::get('/brand', 'AdminBrandController@index')->name('admin.brand.index');
    Route::get('/brand/add', 'AdminBrandController@add')->name('admin.brand.add');

    //promotion
    Route::get('/promotion', 'AdminPromotionController@index')->name('admin.promotion.index');
    Route::get('/promotion/add', 'AdminPromotionController@add')->name('admin.promotion.add');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
