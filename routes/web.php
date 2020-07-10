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
    Route::get('/add/albums','InputController@add_albums')->name('add.albums');
    Route::get('/add/genre','InputController@add_genre')->name('add.genres');
    Route::get('/add/games','InputController@add_games')->name('add.games');
    Route::get('/add/movies','InputController@add_movies')->name('add.movies');
    Route::get('/add/series','InputController@add_series')->name('add.series');
    Route::post('/post/albums/','ContentController@post_albums')->name('post.albums');
    Route::post('/post/pc/games/','ContentController@post_games')->name('post.games');
    Route::post('/post/movies/','ContentController@post_movies')->name('post.movies');
    Route::post('/post/series/','ContentController@post_series')->name('post.series');
    Route::post('/post/genre/','ContentController@post_genres')->name('post.genre');
    Route::post('/post/games/','ContentController@post_games')->name('post.games');
    Route::post('/update/link/database','ContentController@updated_link')->name('update.link');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
