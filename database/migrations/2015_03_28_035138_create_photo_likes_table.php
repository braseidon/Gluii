<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoLikesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_likes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('photo_id')->unsigned()->nullable()->index();
        });

        // Foreign keys
        Schema::table('photo_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photo_likes');
    }
}
