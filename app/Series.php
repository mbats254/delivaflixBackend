<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{

    protected $fillable = [
        'title', 'genre', 'poster','year','rating','backdrop','plot','logo','url','imdb_id','product_code','season_available','starring','season','size','episode_run_time','price','order_count','status'
    ];
}
