<?php

use Illuminate\Support\Facades\Route;
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


Auth::routes();

Route::group(["middleware" => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@homeUser')->name('homeUser'); 
    Route::get('/request', 'RequestController@newRequest')->name('request');
    Route::post('/request/submit', 'RequestController@submit')->name('request-form');
    Route::get('/request/all', 'RequestController@allDataUser')->name('request-data');
    Route::get('/request/all/{id}/update', 'RequestController@updateRequest')->name('request-update');
    Route::post('/request/all/{id}/update', 'RequestController@updateSubmit')->name('request-update-submit');
    Route::get('/request/all/{id}/close', 'RequestController@close')->name('close');

    Route::group(['middleware' => 'manager'], function () {
        Route::get('/manager', 'HomeController@homeManager')->name('homeManager');
        Route::get('/manager/request/all', 'RequestController@allData')->name('request-data-manager');
        Route::get('/manager/request/all/{id}/update', 'RequestController@updateRequestManager')->name('request-update-manager');
        Route::post('/manager/request/all/{id}/update', 'RequestController@updateSubmitManager')->name('request-update-manager-submit');
        Route::get('/manager/request/all/{id}/accept', 'RequestController@accept')->name('accept');   
    });
});


