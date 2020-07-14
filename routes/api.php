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

// Route::middleware('auth:api')->group(function() {

// });
Route::get('/all/movies','SiteController@all_movies')->name('all.movies');
Route::get('/all/series','SiteController@all_series')->name('all.series');
Route::get('/all/albums','SiteController@all_albums')->name('all.albums');
Route::get('/all/games','SiteController@all_games')->name('all.games');
Route::get('/single/movie/{uniqid}','SiteController@single_movie')->name('single.movies');
Route::get('/single/series/{uniqid}','SiteController@single_series')->name('single.series');
Route::get('/single/album/{uniqid}','SiteController@single_album')->name('single.album');
Route::get('/single/game/{uniqid}','SiteController@single_game')->name('single.game');
Route::get('/next/item','SiteController@next_item')->name('next_item');
Route::post('/cart/products','SiteController@cart_products')->name('cart.products');
Route::post('/cart/location/','SiteController@cart_location')->name('cart.location');
Route::post('/cart/payments/','SiteController@cart_payments')->name('cart.payments');
