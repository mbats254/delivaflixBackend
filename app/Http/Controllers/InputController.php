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

}
