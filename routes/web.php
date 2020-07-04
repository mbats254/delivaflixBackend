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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/add/albums','ContentController@add_albums')->name('add.albums');
    Route::get('/add/games','ContentController@add_games')->name('add.games');
    Route::get('/add/movies','ContentController@add_movies')->name('add.movies');
    Route::get('/add/series','ContentController@add_series')->name('add.series');
    Route::post('/post/albums/','ContentController@post_albums')->name('post.albums');
    Route::post('/post/pc/games/','ContentController@post_games')->name('post.games');
    Route::post('/post/movies/','ContentController@post_movies')->name('post.movies');
    Route::post('/post/series/','ContentController@post_series')->name('post.series');
});
