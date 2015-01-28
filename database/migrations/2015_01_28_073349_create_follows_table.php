<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follows', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('follower_id')->unsigned()->index();
			$table->integer('followed_id')->unsigned()->index();
			$table->timestamps();
		});

		// Foreign keys
		Schema::table('follows', function(Blueprint $table)
		{
			$table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('follows');
	}

}
