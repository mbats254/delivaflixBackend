<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('genre');
            $table->string('poster');
            $table->bigInteger('year');
            $table->bigInteger('rating');
            $table->string('product_code');
            $table->bigInteger('size');
            $table->bigInteger('price')->nullable();
            $table->string('dlink');
            $table->string('artist');
            $table->longText('tracklist');
            $table->bigInteger('order_count')->default(0);
            $table->bigInteger('status')->default(0);
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
        Schema::dropIfExists('albums');
    }
}
