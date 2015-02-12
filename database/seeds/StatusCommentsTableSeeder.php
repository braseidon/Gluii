<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
use App\User;
use App\Status;
use App\Comment;

class StatusCommentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$faker = Faker::create();
		$userIds = User::lists('id');
		$statusIds = Status::lists('id');

		foreach(range(1, 1500) as $index)
		{
			Comment::create([
				'user_id'			=> $faker->randomElement($userIds),
				'status_id'			=> $faker->randomElement($statusIds),
				'body'				=> $faker->sentence(),
				'created_at'		=> $faker->dateTime()
			]);
		}
	}

}