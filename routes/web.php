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

Route::group(['prefix' => 'admin', 'middleware' => ['auth','auto_check_permission'], 'namespace' => 'Admin'], function () {
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
    Route::get('restaurant-activate/{id}', 'RestaurantController@activate')->name('restaurant-activate');
    Route::get('restaurant-deactivate/{id}', 'RestaurantController@deactivate')->name('restaurant-deactivate');
    Route::post('status-filter', 'RestaurantController@statusFilter')->name('restaurants.status-filter');

    Route::resource('clients', 'ClientController');
    Route::get('filter-clients', 'ClientController@filter')->name('clients.filter');
    Route::get('activate/{id}', 'ClientController@activate')->name('activate');
    Route::get('deactivate/{id}', 'ClientController@deactivate')->name('deactivate');
    Route::post('active-filter', 'ClientController@activeFilter')->name('clients.active-filter');

    Route::resource('orders', 'OrderController');
    Route::get('filter-orders', 'OrderController@filter')->name('orders.filter');
    Route::post('filter-status', 'OrderController@filterStatus')->name('orders.filter-status');
    Route::get('/print_order/{id}', 'OrderController@print_order')->name('orders.print-order');

    Route::resource('payment-methods', 'PaymentMethodsController');

    Route::resource('contacts', 'ContactController');
    Route::get('filter-contacts', 'ContactController@filter')->name('contacts.filter');

    Route::resource('settings', 'SettingController');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    //================= this route for change language ( ar - en ) ===================//
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    })->name('lang');
});
