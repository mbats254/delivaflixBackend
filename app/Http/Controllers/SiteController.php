<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Movies;
use \App\Series;
use \App\Albums;
use \App\Games;
use \App\Cart;

class SiteController extends Controller
{
    public $successStatus = 200;/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function all_movies(Request $request)
    {
        $movies = Movies::orderBy('id','desc')->get();
        if(count($movies) > 0) {
            return response()->json(['success' => $movies], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function all_series(Request $request)
    {
        $series = Series::orderBy('id','desc')->get();
        if(count($series) > 0) {
            return response()->json(['success' => $series], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function all_albums(Request $request)
    {
        $albums = Albums::orderBy('id','desc')->get();
        if(count($albums) > 0) {
            return response()->json(['success' => $albums], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function all_games(Request $request)
    {
        $games = Games::orderBy('id','desc')->get();
        if(count($games) > 0) {
            return response()->json(['success' => $games], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function single_movie(Request $request)
    {
        $movie = Movies::where('product_code','=',$request->uniqid)->get()->first();
        if($movie !== null) {
            return response()->json(['success' => $movie], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function single_series(Request $request)
    {
        $series = Series::where('product_code','=',$request->uniqid)->get()->first();
        if($series !== null) {
            return response()->json(['success' => $series], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function single_album(Request $request)
    {
        $series = Series::where('product_code','=',$request->uniqid)->get()->first();
        if($series !== null) {
            return response()->json(['success' => $series], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function single_game(Request $request)
    {
        $game = Games::where('product_code','=',$request->uniqid)->get()->first();
        if($game !== null) {
            return response()->json(['success' => $game], $this->successStatus);
        } else {
            return response()->json(404);
        }
    }

    public function cart_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'contact' => 'required',
            'user_authetication' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
}
        $response = $request->all();
    // $user = \DB::table('users')->where('email','=',$response['email'])->get()->toArray();
        $cart = Cart::updateorCreate([
            'product_id' => $response['product_id'],
            'contact' => $response['contact'],
            'user_authetication' => $response['user_authetication'],
            'price' => $response['price'],
            'uniqid' => uniqid()
        ]);
        return response()->json($cart);
    }

    public function cart_location(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uniqid' => 'required',
            'user_location' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
            $response = $request->all();
        $cart = Cart::where('uniqid','=',$response['uniqid'])->get()->first();
        Cart::where('uniqid','=',$response['uniqid'])->update([
            'order_location' => $response['order_location']
        ]);
        return response()->json($cart);
    }
    public function cart_payments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uniqid' => 'required',
            'payment' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
            $response = $request->all();
        $cart = Cart::where('uniqid','=',$response['uniqid'])->get()->first();
        Cart::where('uniqid','=',$response['uniqid'])->update([
            'payment' => $response['payment'],
        ]);
        return response()->json($cart);
    }
}
