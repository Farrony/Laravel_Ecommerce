<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {

    Route::get('/dashboard','App\Http\Controllers\Backend\PageController@dashboard')->name('admin.dashboard');


    Route::group(['prefix' => '/brands'], function () {
        Route::get('/manage','App\Http\Controllers\Backend\BrandController@index')->name('brands.manage');
        Route::get('/create','App\Http\Controllers\Backend\BrandController@create')->name('brands.create');
        Route::post('/store','App\Http\Controllers\Backend\BrandController@store')->name('brands.store');
        Route::get('/edit/{id}','App\Http\Controllers\Backend\BrandController@edit')->name('brands.edit');
        Route::post('/edit/{id}','App\Http\Controllers\Backend\BrandController@update')->name('brands.update');
        Route::post('/destroy/{id}','App\Http\Controllers\Backend\BrandController@destroy')->name('brands.destroy');      
    });

    Route::group(['prefix' => '/category'], function () {
        Route::get('/manage','App\Http\Controllers\Backend\CategoryController@index')->name('category.manage');
        Route::get('/create','App\Http\Controllers\Backend\CategoryController@create')->name('category.create');
        Route::post('/store','App\Http\Controllers\Backend\CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','App\Http\Controllers\Backend\CategoryController@edit')->name('category.edit');
        Route::post('/edit/{id}','App\Http\Controllers\Backend\CategoryController@update')->name('category.update');
        Route::post('/destroy/{id}','App\Http\Controllers\Backend\CategoryController@destroy')->name('category.destroy');      
    });
});

