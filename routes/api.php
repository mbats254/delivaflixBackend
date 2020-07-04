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

Route::middleware('auth:api')->group(function() {
    Route::post('/post/albums/','ContentController@post_albums')->name('post.albums');
    Route::post('/post/pc/games/','ContentController@post_games')->name('post.games');
    Route::post('/post/movies/','ContentController@post_movies')->name('post.movies');
    Route::post('/post/series/','ContentController@post_series')->name('post.series');

});
