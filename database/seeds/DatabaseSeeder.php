<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		$this->call('UserTableSeeder');

		$this->command->info('Таблица пользователей заполнена данными!');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
        $password = Hash::make('manager');
		User::create(array('name' => 'manager', 'email' => 'av.fedorova@mail.ru', 'is_manager' => true, 'password' => $password));
	}

}
