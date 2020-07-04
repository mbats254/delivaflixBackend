<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('genre');
            $table->string('poster');
            $table->string('backdrop');
            $table->string('logo');
            $table->string('title');
            $table->longText('plot');
            $table->longText('starring');
            $table->bigInteger('size');
            $table->bigInteger('price');
            $table->bigInteger('year');
            $table->bigInteger('episode_run_time');
            $table->string('status');
            $table->bigInteger('season');
            $table->string('season_available');
            $table->bigInteger('product_code');
            $table->bigInteger('rating');
            $table->bigInteger('order_count');
            $table->string('url');
            $table->bigInteger('imdb_id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
