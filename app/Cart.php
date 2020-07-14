<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // $table->string('');
    // $table->string();
    // $table->string();
    // $table->string(,10);
    // $table->string();
    // $table->string();
    // $table->bigInteger('status')->default(0);
    // $table->dateTime('',0);
    // $table->dateTime('');
    // $table->string('');
    protected $fillable = [
        'product_id','payment','uniqid','price','user_authetication','contact','order_location', 'delivery_guy', 'order_time','delivery_time','status'
    ];
}
