<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatusesTableRenameUserIdToAuthorId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('statuses', function(Blueprint $table)
		{
			$table->dropForeign('statuses_user_id_foreign');
			$table->renameColumn('user_id', 'profile_user_id');
			$table->integer('author_id')->unsigned()->index()->after('user_id');
		});

		// Foreign keys
		Schema::table('statuses', function(Blueprint $table)
		{
			$table->foreign('profile_user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Foreign keys
		Schema::table('statuses', function(Blueprint $table)
		{
			$table->dropForeign('statuses_author_id_foreign');
		});

		Schema::table('statuses', function(Blueprint $table)
		{
			$table->dropColumn('author_id');
		});
	}

}
