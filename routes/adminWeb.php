<?php

use Illuminate\Support\Facades\Route;

########################      admins login            ###############################
Route::group(['prefix'=>'admins','namespace'=>'admins','middleware'=>'guest:admins'], function () {
    Route::get ('/get/login'       , 'AdminsController@getLogin')->name('admin.login');
    Route::post('/login'           , 'AdminsController@login');
});

########################        dashboard           ###############################
Route::group(['prefix'=>'admins','namespace'=>'admins','middleware'=>'auth:admins'], function () {
    Route::get ('/dashboard'       , 'DashboardController@index');
});

########################        admins            ###############################
Route::group(['prefix'=>'admins','namespace'=>'admins','middleware'=>'auth:admins'], function () {
    Route::get ('/logout'          , 'AdminsController@logout');
    Route::get ('/show'            , 'AdminsController@index');
    Route::get ('/create'          , 'AdminsController@create');
    Route::get ('/edit/{id}'       , 'AdminsController@edit');
    Route::get ('/delete/{id}'     , 'AdminsController@delete');
    Route::post('/store'           , 'AdminsController@store');
    Route::post('/update/{id}'     , 'AdminsController@update');
});

########################      category multilanguage            ###############################
//lang_prefix and adminsMiddleware autoload from app\helpers\admins
Route::group(['prefix'=> lang_prefix().'/admins/category' ,'namespace'=>'admins',
            'middleware'=>adminsMiddleware()], function () {
    Route::get ('/show'            , 'CategoryController@index');
    Route::get ('/create'          , 'CategoryController@create');
    Route::get ('/edit/{id}'       , 'CategoryController@edit');
    Route::get ('/delete/{id}'     , 'CategoryController@delete');
    Route::post('/store'           , 'CategoryController@store');
    Route::post('/add/new_lang'    , 'CategoryController@addNewLang');
    Route::post('/update/{id}'     , 'CategoryController@update');
});

########################      language            ###############################
Route::group(['prefix'=>'admins/language','namespace'=>'admins','middleware'=>'auth:admins'], function () {
    Route::get ('/show'            , 'LanguageController@index');
    Route::get ('/create'          , 'LanguageController@create');
    Route::post('/store'           , 'LanguageController@store');
});

########################      items            ###############################
Route::group(['prefix'=>'admins/items','namespace'=>'admins','middleware'=>'auth:admins'], function () {
    Route::get ('/show'            , 'ItemsController@index');
    Route::get ('/create'          , 'ItemsController@create');
    Route::post('/store'           , 'ItemsController@store');
    Route::get ('/edit/{id}'       , 'ItemsController@edit');
    Route::get ('/delete/{id}'     , 'ItemsController@delete');
    Route::post('/update/{id}'     , 'ItemsController@update');
});


