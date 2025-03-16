<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('home');

########################      items            ###############################
Route::group(['prefix' => 'items','namespace'=>'users'], function () {
    Route::get    ('/create'                , 'ItemsController@index');
    Route::get    ('/comments/{id}'         , 'ItemsController@comInfiniteScroll');
    Route::get    ('/get/checkout'          , 'ItemsController@getCheckout');
    Route::get    ('/details/{slug}'        , 'ItemsController@showDetails')->name('item.details');
    Route::get    ('/edit'                  , 'ItemsController@editItem');
    Route::any    ('/get'                   , 'ItemsController@show')->name('item.get');
    Route::post   ('/post'                  , 'ItemsController@create')->name('items.insert');
    Route::post   ('/update'                , 'ItemsController@update');
    Route::post   ('/show/results'          , 'ItemsController@showResults');
    Route::post   ('/rate'                  , 'ItemsController@rate');
    Route::get    ('/get/rating'            , 'ItemsController@getRate');
    Route::delete ('/delete'                , 'ItemsController@deleteItem');
});

########################      orders            ###############################
Route::group(['prefix' => 'orders','namespace'=>'users'], function () {
    Route::get    ('/show'        , 'OrdersController@index');
    Route::get    ('/cancel/{id}' , 'OrdersController@delete');
});

########################      comments            ###############################
Route::group(['prefix' => 'comments','namespace'=>'users'], function () {
    Route::get   ('/edit/{id}'            , 'CommentController@edit');
    Route::post  ('/post/{id}'            , 'CommentController@create')->name('comment.create');
    Route::post  ('/update/{id}'          , 'CommentController@update');
    Route::get   ('/delete/{id}'          , 'CommentController@delete');
});


########################      category            ###############################
Route::group(['prefix' => 'category','namespace'=>'users'], function () {
    Route::get ('/get'               , 'CategoryController@index')->name('category.get');
    Route::get ('/show/items/{id}'   , 'CategoryController@show');
});

########################      profile            ###############################
Route::group(['prefix' => 'profile','namespace'=>'users'], function () {
    Route::get  ('/get'           , 'ProfileController@index')->name('profile.get');
    Route::post ('/update'        , 'ProfileController@update')->name('update.profile');
    Route::post ('/update/photo'  , 'ProfileController@updatePhoto');
});

########################      Notifications            ###############################
Route::group(['prefix' => 'notifications','namespace'=>'users'], function () {
    Route::get   ('/show'         , 'NotificationsController@show');
    Route::post  ("/update"       , 'NotificationsController@update');
});

