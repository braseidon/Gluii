<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('likable_id')->unsigned()->index();
            $table->string('likable_type', 255)->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['likable_id', 'likable_type', 'user_id'], 'likeable_likes_unique');
        });

        Schema::create('like_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('likable_id')->unsigned()->index();
            $table->string('likable_type')->index();
            $table->integer('count')->unsigned()->default(0);
            $table->unique(['likable_id', 'likable_type'], 'likeable_counts');
        });
    }
    public function down()
    {
        Schema::drop('likes');
        Schema::drop('like_counters');
    }
}
