<?php

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

//===================================================================================//

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('auth.login');
});

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/admin', function () {
        return view('admin.home');
    });

    Route::resource('cities', 'CityController');
    Route::resource('regions', 'RegionController');
    Route::resource('categories', 'CategoryController');

    Route::resource('transactions', 'TransactionController');
    Route::get('filter-transactions', 'TransactionController@filter')->name('transactions.filter');

    Route::resource('offers', 'OfferController');
    Route::get('filter-offers', 'OfferController@filter')->name('offers.filter');

    Route::resource('restaurants', 'RestaurantController');
    Route::get('filter-restaurants', 'RestaurantController@filter')->name('restaurants.filter');
    Route::get('activate/{id}', 'RestaurantController@activate')->name('activate');
    Route::get('deactivate/{id}', 'RestaurantController@deactivate')->name('deactivate');
    Route::post('status-filter', 'RestaurantController@statusFilter')->name('restaurants.status-filter');

    Route::resource('contacts', 'ContactController');
    Route::get('filter-contacts', 'ContactController@filter')->name('contacts.filter');

    Route::resource('settings', 'SettingController');

    //================= this route for change language ( ar - en ) ===================//
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    })->name('lang');
});
