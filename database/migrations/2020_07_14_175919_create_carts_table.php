<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('price');
            $table->string('user_authetication');
            $table->string('contact',10);
            $table->string('order_location')->nullable();
            $table->string('payment')->nullable();
            $table->bigInteger('status')->default(0);
            $table->dateTime('delivery_time',0)->nullable();
            $table->dateTime('order_time')->nullable();
            $table->string('delivery_guy')->nullable();
            $table->string('uniqid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
