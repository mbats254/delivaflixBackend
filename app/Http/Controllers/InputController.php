<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Genre;
class InputController extends Controller
{
    //
    public function add_albums(Request $request)
    {
        return view('admin_portal.add_albums');
    }

    public function add_movies(Request $request)
    {
        return view('admin_portal.add_movies');
    }

    public function add_series(Request $request)
    {
        return view('admin_portal.add_series');
    }

    public function add_genre(Request $request)
    {
        return view('admin_portal.add_genres');
    }

    public function add_games(Request $request)
    {
        $all_genres  = Genre::get();
        $genres = [];
        for($i=0;$i<sizeof($all_genres);$i++)
        {
            $item_name = explode(",",$all_genres[$i]->item_name);
            if(in_array('Games',$item_name))
            {
                array_push($genres,$all_genres[$i]->title);
            }
        }

        return view('admin_portal.add_games',compact('genres'));
    }

    public function add_item(Request $request)
    {
        return view('admin_portal.add_item');
    }
}
