<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace' => 'Api'],function (){

    Route::get('cities', 'MainController@cities');
    Route::get('regions', 'MainController@regions');
    Route::get('categories', 'MainController@categories');
    Route::get('payment-methods','MainController@paymentMethods');

    Route::get('restaurants', 'MainController@restaurants');
    Route::get('restaurant', 'MainController@restaurant');
    Route::get('restaurant/reviews','MainController@reviews');

    Route::get('items', 'MainController@items');

    Route::get('offers', 'MainController@offers');
    Route::get('offer', 'MainController@offer');

    Route::get('contact-us','MainController@contacts');
    Route::post('contact-us','MainController@add_contact');

    Route::get('settings','MainController@settings');

    //================================ Clients  ================================//

    Route::group(['prefix' => 'client','namespace' => 'client'],function (){
        Route::post('register','AuthController@register');
        Route::post('login','AuthController@login');
        Route::post('reset-password','AuthController@resetPassword');
        Route::post('new-password','AuthController@newPassword');

        Route::group(['middleware' => 'auth:client'],function (){
            Route::post('profile','AuthController@profile');
            Route::post('new-order','MainController@newOrder');
        });

    });

    //================================ Restaurants  ================================//

    Route::group(['prefix' => 'restaurant','namespace' => 'restaurant'],function (){
        Route::post('register','AuthController@register');
        Route::post('login','AuthController@login');
        Route::post('reset-password','AuthController@resetPassword');
        Route::post('new-password','AuthController@newPassword');
        Route::post('profile','AuthController@profile');

        Route::group(['middleware' => 'auth:restaurant'],function (){
            Route::post('profile','AuthController@profile');
        });
    });

});
