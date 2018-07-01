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


// Auth::routes();
Route::get('empty',function () {
    	return view('empty');
	});
Route::get('/verify/{username}/{token}','VerificationController@verify')->name('verify');
Route::middleware(['guest'])->group(function(){
	
	Route::get('/', function () {
    	return view('landing');
	})->name('landing');
	Route::get('/login', 'SessionsController@index')->name('login')->middleware('VerifyAccount');;
	Route::post('/login', 'SessionsController@create');
	Route::get('/signup', 'SignupController@index')->name('signup');
	Route::post('/signup', 'SignupController@create');

	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::middleware(['VerifyAccount','auth','web'])->group(function(){
	
	Route::get('/myprofile', function () {
	    return view('myprofile');
	})->name('myprofile');
	Route::get('/restaurants','RestaurantController@index')->name('restaurants');
	Route::get('/restaurant/new','RestaurantController@new');
	Route::post('/restaurant/new','RestaurantController@create');
	Route::get('/restaurant/{id}','RestaurantController@show')->name('restaurant.show');
	Route::get('/restaurant/{id}/edit','RestaurantController@edit');
	Route::get('/restaurant/{id}/claim','RestaurantController@claim');
	Route::get('/restaurant/{id}/restore','RestaurantController@restore');
	Route::get('/restaurant/{id}/delete','RestaurantController@destroy');
	Route::post('/restaurant/{id}/edit','RestaurantController@update');
	Route::post('/rating/{id}/edit','RatingController@update');
	Route::post('/restaurant/{id}/unclaim','RestaurantController@unclaim');
	Route::get('/search','RestaurantController@search');
	
	Route::post('/myprofile', 'SessionsController@edit');
	Route::get('/myrestaurants', 'RestaurantController@myrestaurants');
	Route::get('/reserved', 'RestaurantController@reserved');
	
});

Route::middleware(['auth'])->group(function(){
	Route::get('/verifyAccount','VerificationController@index')->name('verifyAccount');
	Route::get('/email/resend','SignupController@resendVerification');
	Route::get('/logout', 'SessionsController@destroy');
	

});












