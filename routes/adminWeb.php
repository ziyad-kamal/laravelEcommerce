<?php

use Illuminate\Support\Facades\Route;

########################      admins login            ###############################
Route::group(['prefix'=>'admins','namespace'=>'admins','middleware'=>'guest:admins'], function () {
    Route::get ('/get/login'           , 'AdminsController@getLogin')->name('admin.login');
    Route::post ('/login'              , 'AdminsController@login');
});

########################      dashboard and logout          ###############################
Route::group(['prefix'=>'admins','namespace'=>'admins','middleware'=>'auth:admins'], function () {
    Route::get ('/dashboard'           , 'AdminsController@getDashboard');
    Route::get ('/logout'              , 'AdminsController@logout');
    
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

