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
        User::create([
            'name' => 'User Master', 
            'email' => 'master@gmail.com', 
            'password' => bcrypt('secret')
                ]);
        User::create([
            'name' => 'User Administrador', 
            'email' => 'ucss.fcec.lim@gmail.com', 
            'password' => bcrypt('secret')
                ]);
        User::create([
            'name' => 'User Responsable', 
            'email' => 'responsable@gmail.com', 
            'password' => bcrypt('secret')
                ]);
        User::create([
            'name' => 'User Docente', 
            'email' => 'docente@gmail.com', 
            'password' => bcrypt('secret')
                ]);
        User::create([
            'name' => 'User Consulta', 
            'email' => 'consulta@gmail.com', 
            'password' => bcrypt('secret')
                ]);

        factory(User::class,5)->create();
    }
}
