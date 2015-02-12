<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
use App\User;
use App\Status;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$faker = Faker::create();

		foreach(range(1, 25) as $index)
		{
			User::create([
				'first_name'	=> $faker->firstName,
				'last_name'		=> $faker->lastName,
				'email'			=> $faker->email,
				'password'		=> 'secret'
			]);
		}
	}

}