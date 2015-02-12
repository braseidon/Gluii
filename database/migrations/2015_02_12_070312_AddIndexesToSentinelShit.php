<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToSentinelShit extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Activations
		Schema::table('activations', function(Blueprint $table)
		{
			$table->index('user_id');
			$table->index('completed');
		});

		// Throttle
		Schema::table('throttle', function(Blueprint $table)
		{
			$table->index('type');
			$table->index('ip');
			$table->index('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Activations
		Schema::table('activations', function(Blueprint $table)
		{
			$table->dropIndex('activations_user_id_index');
			$table->dropIndex('activations_completed_index');
		});

		// Throttle
		Schema::table('throttle', function(Blueprint $table)
		{
			$table->dropIndex('throttle_type_index');
			$table->dropIndex('throttle_ip_index');
			$table->dropIndex('throttle_created_at_index');
		});
	}

}
