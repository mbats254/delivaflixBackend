<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $fillable = [
        'title', 'genre', 'poster','year','rating','product_code','size','price','requirements','youtube_id','publisher','order_count','status'
    ];
}
