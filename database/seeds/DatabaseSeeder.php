<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * @var array
	 */
	protected $tables = [
		'users',
		'statuses'
	];

	/**
	 * @var array
	 */
	protected $seeders = [
		'UsersTableSeeder',
		'StatusTableSeeder',
		'StatusCommentsTableSeeder',
		'StatusLikesTableSeeder',
		// 'StatusCommentLikesTableSeeder',
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->cleanDatabase();

		foreach ($this->seeders as $seedClass)
		{
			$this->call($seedClass);
		}
	}

	/**
	 * Clean out the database for a new seed generation.
	 */
	private function cleanDatabase()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		foreach ($this->tables as $table)
		{
			DB::table($table)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
