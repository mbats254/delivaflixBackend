<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('title');
            $table->string('poster');
            $table->longText('requirements');
            $table->bigInteger('year');
            $table->bigInteger('price');
            $table->bigInteger('size');
            $table->bigInteger('rating');
            $table->string('genre');
            $table->string('publisher');
            $table->bigInteger('order_count')->default(0);
            $table->bigInteger('status')->default(0);
            $table->string('youtube_id');
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
        Schema::dropIfExists('games');
    }
}
