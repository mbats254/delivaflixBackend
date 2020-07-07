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
    public function url_get_contents( $url ) {
        if ( ! function_exists( 'curl_init' ) ) {
            die( 'The cURL library is not installed.' );
        }
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );
        return $output;
    }

    public function post_movies(Request $request)
    {
        $this->validate($request, [
            // 'imdb_id' => 'unique:movies|required',
            // 'genre' => 'max:255|required',
            // 'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            // 'backdrop' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            // 'youtube_id' => 'required',

            ]);
            $baseURL = 'https://api.themoviedb.org/3/';
            $baseImageURL = 'https://image.tmdb.org/t/p/';
            $APIKEY = '1b6741a859c40a4e6458e2936606c45b';
            $size = $_GET['size'];
            $quality = $_GET['quality'];
            $imdb = $_GET['imdb'];
            $searchstr = ''.$baseURL.'movie/'.$imdb.'?api_key='.$APIKEY.'&append_to_response=videos,images';
            $imdbarr = $this->url_get_contents($searchstr);
            $arr = json_decode($imdbarr, TRUE);
            $duration = $arr['runtime'];
            $year = $arr['release_date']; 
            $plotraw = $arr['overview'];
            $plot = str_replace("'", '&' , $plotraw);
            $title = str_replace("'", "&", $arr['title']);
            $rating = $arr['vote_average'];
            $posterraw = $arr['poster_path'];
            $poster = $baseImageURL.'w185'.$posterraw;
            $rawbackdrop = $arr['backdrop_path'];
            $backdrop = $baseImageURL.'w780'.$rawbackdrop;
            $logosize = $baseImageURL.'w45'.$posterraw;
            $vids = $arr['videos'];
            
            $vids1 = $vids['results'];
            if(sizeof($vids1) > 0){
                $url = $vids1[0]['key'];
            }
            else {
                $url = '/';
            }          
            $genres = $arr['genres'];            
            $price=20;
            $status=0;
            //genre(s)
            $all_genres = [];
            for($i=0;$i<sizeof($genres);$i++)
            {
                array_push($all_genres,$genres[$i]['name']);
            }            
            $genres_str = implode(',',$all_genres);

            $searchcredits = ''.$baseURL.'movie/'.$imdb.'/credits?api_key='.$APIKEY;
            $creditarr = $this->url_get_contents($searchcredits);
            $creditarr1 = json_decode($creditarr, TRUE);
            $creditstr = '';
            $cast = $creditarr1["cast"];
            //cast
            $all_cast = [];
            for($i=0;$i<sizeof($cast);$i++)
            {
                array_push($all_cast,$cast[$i]['id']);
            }
            $cast_str = implode(',',$all_cast);
            //production companies
            $all_companies = [];            
            for($i=0;$i<sizeof($arr['production_companies']);$i++)
            {
                array_push($all_companies,$arr['production_companies'][$i]['logo_path']);
            }
            $companies_str = implode(',',$all_companies);
            
            $check = Movies::where('imdb_id','=',$imdb)->get()->count();
            if($check > 0)
            {
                return 0;
            } else
            {
                $uniqid = uniqid();
        
             $movies = Movies::updateorCreate([
                    'title' => $title,
                    'genre' => $genres_str,
                    'poster' => $poster,
                    'quality' => $quality,
                    'year' => $year,
                    'rating' => $rating,
                    'product_code' => $uniqid,
                    'size' => $size,
                    'price' => $price,
                    'backdrop' => $backdrop,
                    'plot' => $plot,
                    'imdb_id' => $imdb,
                    'companies' => $companies_str,
                    'starring' => $cast_str,
                    'youtube_id' => $url,
                    'duration' => $duration,
                    'logo' => $logosize,
                    'price' => 40
                ]);
                Log::info($movies->title." Added Successfully");
                $request->session()->flash("success",$movies->title." Added Successfully");
                return redirect()->back();
            }            
    
       
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
    public function updated_link(Request $request)
    {

    }

}
