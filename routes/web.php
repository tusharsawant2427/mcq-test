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

Route::get('/', 'HomeController@Login')->name('thank-you');


Route::get('/thank-you/{id}', 'HomeController@Thankyou')->name('thank-you');

Route::get('/test', 'HomeController@index')->name('start_test');
Route::post('/test', 'HomeController@store')->name('store');


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Auth\LoginController@login');

    //Forgot Password Routes
    Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.update');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'namespace'=>'Admin'], function () {
    
    Route::get('/dashboard', 'HomeController@dashboard')->name('admin.dashboard');
    Route::post('/user-list', 'HomeController@UseList')->name('admin.user-list');
    Route::post('/logout','Auth\LoginController@logout')->name('admin.logout');

});


Auth::routes();
