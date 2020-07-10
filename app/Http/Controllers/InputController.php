<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin_portal.add_games');
    }
}
