<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToPhotoAdumIdOnPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Photos
		Schema::table('photos', function($table)
		{
			$table->integer('album_id')->unsigned()->nullable()->change();
		});

		// Users
		Schema::table('users', function($table)
		{
			$table->integer('profile_photo_id')->unsigned()->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Photos
		Schema::table('photos', function($table)
		{
			$table->integer('album_id')->unsigned()->change();
		});

		// Users
		Schema::table('users', function($table)
		{
			$table->integer('profile_photo_id')->unsigned()->change();
		});
	}

}
