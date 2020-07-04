<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact',10);
            $table->longText('wishlist')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('recovery_code')->nullable();
            $table->dateTime('recovery_time')->nullable();
            $table->bigInteger('recovery_status')->nullable();
            $table->bigInteger('rank');
            $table->bigInteger('points')->nullable();
            $table->longText('subscription')->nullable();
            $table->bigInteger('account_status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
