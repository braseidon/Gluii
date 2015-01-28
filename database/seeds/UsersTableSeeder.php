<?php

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
 		$amount = 50;

 		$first = Storage::get('first_name.txt');
 		dd($first);
 		$last = Storage::get('last_name.txt');

 		for($x = 0;$x < $amount;$x++)
 		{
 			$email = str_random(10);
			User::create([
				'email' => $email . '@gmail.com',
				'first_name' => 'Alex',
				'last_name' => 'Sears',
				'password' => Hash::make('alexsears')
			]);
 		}

    }

}