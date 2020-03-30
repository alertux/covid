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

Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
Route::get('register_win',  'Auth\RegisterController@showRegistrationForm')->name('register_win');

Route::post('login', 'Auth\LoginController@login');
Auth::routes(['register' => false]);
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'general']], function () {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

    Route::resource('places', 'Management\PlaceController');
    Route::resource('trip', 'Management\TripController');
    Route::resource('contacts', 'Management\ContactController');
    Route::resource('report', 'Management\ReportController');
    Route::resource('diagnosis', 'Management\DiagnosisController');

    Route::resource('users', 'UsersController');
    Route::resource('category', 'Management\CategoryController');
    Route::resource('product', 'Management\ProductController');
    Route::resource('customer', 'Management\CustomerController');
    Route::resource('validation', 'Management\ValidationController');


    Route::get('product/fill_inventory/{id}', ['as' => 'product.fill_inventory', 'uses' => 'Management\ProductController@fill_inventory']);

});


Route::group(['middleware' => ['auth', 'general'], 'prefix' => 'api', 'as' => 'api::'], function(){
    Route::get('customers', ['as' => 'customers', 'uses' => 'ApiController@customers']);
    Route::get('products_by_code', ['as' => 'products', 'uses' => 'ApiController@products_by_code']);
    Route::get('products_by_name', ['as' => 'products', 'uses' => 'ApiController@products_by_name']);
    Route::get('contracts', ['as' => 'contracts', 'uses' => 'ApiController@contracts']);
    Route::get('reports', ['as' => 'reports', 'uses' => 'ApiController@reports']);
    Route::get('all_contracts', ['uses' => 'ApiController@all_contracts']);
});




