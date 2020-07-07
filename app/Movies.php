<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{

    protected $fillable = [
        'title', 'genre', 'poster','year','rating','backdrop','plot','quality','logo','url','imdb_id','product_code','companies','starring','youtube_id','size','duration','price','order_count','status'
    ];
}
