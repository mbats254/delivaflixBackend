<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('genre');
            $table->string('poster');
            $table->string('backdrop');
            $table->string('logo');
            $table->string('title');
            $table->longText('plot');
            $table->longText('starring');
            $table->bigInteger('size');
            $table->string('year');
            $table->bigInteger('price');
            $table->string('quality');
            $table->bigInteger('duration');
            $table->bigInteger('status')->default(0);
            $table->longText('companies');
            $table->string('product_code');
            $table->bigInteger('rating');
            $table->bigInteger('order_count')->default(0);
            $table->string('youtube_id');
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
        Schema::dropIfExists('movies');
    }
}
