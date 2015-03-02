<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilePhotoIdToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->integer('profile_photo_id')->unsigned()->nullable()->index()->after('gender');
			// $table->foreign('profile_photo_id')->references('id')->on('photos')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// $table->dropForeign('users_profile_photo_id_foreign');
		$table->dropColumn('profile_photo_id');
	}

}
