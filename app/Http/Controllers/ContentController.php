<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Albums;
use \App\Games;
use \App\Movies;
use \App\Series;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ContentController extends Controller
{
    public $successStatus = 200;/**
        * login api
        *
        * @return \Illuminate\Http\Response
        */
    public function post_albums(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:255|unique:albums|required',
            'genre' => 'max:255|required',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'dlink' => 'max:255|required',
            'artist' => 'max:255|required',
            'tracklist' => 'required'
            ]);

            $uniqid = uniqid();
            $poster = $request->file('poster');
            $request->file('poster')->move(base_path() . '/public/Album_Posters/', $file_name = str_replace(" ", "_",'/Album_Posters/'.$request->title .'_'. $uniqid.'_poster') . "." . $poster->getClientOriginalExtension());

        $albums = Albums::updateorCreate([
          'title' => $request->title,
          'genre' => $request->genre,
          'poster' => $file_name,
          'year' => $request->year,
          'rating' => $request->rating,
          'product_code' => $uniqid,
          'size' => $request->size,
          'price' => $request->price,
          'dlink' => $request->dlink,
          'artist' => $request->artist,
          'tracklist' => $request->tracklist,
                  ]);

                  Log::info($albums->title." Added Successfully");
                  $request->session()->flash("success",$albums->title." Added Successfully");
                  return redirect()->back();
    }
    public function post_games(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:255|unique:games|required',
            'genre' => 'max:255|required',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'youtube_id' => 'required',
            'publisher' => 'max:255|required',
            'requirements' => 'required'
            ]);

            $uniqid = uniqid();
            $poster = $request->file('poster');
            $request->file('poster')->move(base_path() . '/public/Games_Posters/', $file_name = str_replace(" ", "_",'/Games_Posters/'.$request->title .'_'. $uniqid.'_poster') . "." . $poster->getClientOriginalExtension());

    $games = Games::updateorCreate([
          'title' => $request->title,
          'genre' => $request->genre,
          'poster' => $file_name,
          'year' => $request->year,
          'rating' => $request->rating,
          'product_code' => $uniqid,
          'size' => $request->size,
          'price' => $request->price,
          'requirements' => $request->requirements,
          'youtube_id' => $request->youtube_id,
          'publisher' => $request->publisher
        ]);
        Log::info($games->title." Added Successfully");
        $request->session()->flash("success",$games->title." Added Successfully");
        return redirect()->back();
    }
    public function post_movies(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:255|unique:games|required',
            'genre' => 'max:255|required',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'backdrop' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'youtube_id' => 'required',

            ]);

        $uniqid = uniqid();
        $poster = $request->file('poster');
        $request->file('poster')->move(base_path() . '/public/Movies_Posters/', $file_name = str_replace(" ", "_",'/Movies_Posters/'.$request->title .'_'. $uniqid.'_poster') . "." . $poster->getClientOriginalExtension());
        $backdrop = $request->file('backdrop');
        $request->file('poster')->move(base_path() . '/public/Movie_Backdrops/', $file_backdrop = str_replace(" ", "_",'/Movie_Backdrops/'.$request->title .'_'. $uniqid.'_backdrop') . "." . $backdrop->getClientOriginalExtension());
        $logo = $request->file('logo');
        $request->file('logo')->move(base_path() . '/public/Movie_Logos/', $file_logo = str_replace(" ", "_",'/Movie_Logos/'.$request->title .'_'. $uniqid.'_logo') . "." . $logo->getClientOriginalExtension());

        $movies = Movies::updateorCreate([
            'title' => $request->title,
            'genre' => $request->genre,
            'poster' => $file_name,
            'year' => $request->year,
            'rating' => $request->rating,
            'product_code' => $uniqid,
            'size' => $request->size,
            'price' => $request->price,
            'backdrop' => $file_backdrop,
            'plot' => $request->plot,
            'url' => $request->url,
            'imdb_id' => $request->imdb_id,
            'companies' => $request->companies,
            'starring' => $request->starring,
            'youtube_id' => $request->youtube_id,
            'duration' => $request->duration,
            'logo' => $file_logo,
            'price' => 40
        ]);
        Log::info($movies->title." Added Successfully");
        $request->session()->flash("success",$movies->title." Added Successfully");
        return redirect()->back();
    }

    public function post_series(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:255|unique:games|required',
            'genre' => 'max:255|required',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'backdrop' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'youtube_id' => 'required',
            'season_available' => 'required',
            'seasons' => 'required',
            'starring' => 'required',
            'episode_run_time' => 'required',

            ]);

        $uniqid = uniqid();
        $poster = $request->file('poster');
        $request->file('poster')->move(base_path() . '/public/Series_Posters/', $file_name = str_replace(" ", "_",'/Series_Posters/'.$request->title .'_'. $uniqid.'_poster') . "." . $poster->getClientOriginalExtension());
        $backdrop = $request->file('backdrop');
        $request->file('poster')->move(base_path() . '/public/Series_Backdrops/', $file_backdrop = str_replace(" ", "_",'/Series_Backdrops/'.$request->title .'_'. $uniqid.'_backdrop') . "." . $backdrop->getClientOriginalExtension());
        $logo = $request->file('logo');
        $request->file('logo')->move(base_path() . '/public/Series_Logos/', $file_logo = str_replace(" ", "_",'/Series_Logos/'.$request->title .'_'. $uniqid.'_logo') . "." . $logo->getClientOriginalExtension());

        $series = Series::updateorCreate([
            'title' => $request->title,
            'genre' => $request->genre,
            'poster' => $file_name,
            'year' => $request->year,
            'rating' => $request->rating,
            'product_code' => $uniqid,
            'size' => $request->size,
            'price' => $request->price,
            'backdrop' => $file_backdrop,
            'plot' => $request->plot,
            'url' => $request->url,
            'imdb_id' => $request->imdb_id,
            'logo' => $file_logo,
            'starring' => $request->starring,
            'youtube_id' => $request->youtube_id,
            'url' => $request->url,
            'season_available' => $request->season_available,
            'seasons' => $request->seasons,
            'episode_run_time' => $request->episode_run_time,
            'price' => 50,
        ]);
        Log::info($series->title." Added Successfully");
        $request->session()->flash("success",$series->title." Added Successfully");
        return redirect()->back();
    }
}
