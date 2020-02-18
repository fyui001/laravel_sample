<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_code');
            $table->string('prefecture_kana', 10);
            $table->string('city_kana', 100);
            $table->string('town_kana', 100);
            $table->string('prefecture', 10);
            $table->string('city', 200);
            $table->string('town', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_code');
    }
}
