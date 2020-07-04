<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
        'title', 'genre', 'poster','year','rating','product_code','size','price','dlink','artist','tracklist','order_count','status'
    ];
}
