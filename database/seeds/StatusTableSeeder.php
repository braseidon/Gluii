<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
use App\User;
use App\Status;

class StatusTableSeeder extends Seeder {

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

		foreach(range(1, 500) as $index)
		{
			Status::create([
				'profile_user_id'	=> $faker->randomElement($userIds),
				'author_id'			=> $faker->randomElement($userIds),
				'body'				=> $faker->sentence(),
				'created_at'		=> $faker->dateTime()
			]);
		}
	}

}