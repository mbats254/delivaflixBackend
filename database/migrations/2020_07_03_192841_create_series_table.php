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
            $table->string('size');
            $table->bigInteger('price');
            $table->string('year');
            $table->bigInteger('episode_run_time');
            $table->string('status')->default(0);
            $table->bigInteger('season');
            $table->string('season_available');
            $table->string('product_code');
            $table->bigInteger('rating');
            $table->bigInteger('order_count')->default(0);
            $table->string('url');
            $table->bigInteger('imdb_id');
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
        Schema::dropIfExists('series');
    }
}
