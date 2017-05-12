<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        	['name' => 'Usuario Master', 'email' => 'admin@gmail.com', 'password' => bcrypt('secret')]);
    }
}
