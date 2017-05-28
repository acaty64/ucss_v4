<?php

use App\DataUser;
use App\User;
use Illuminate\Container\factory;
use Illuminate\Database\Seeder;

class DatausersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataUser::create([
            'user_id' => 1,
            'wdoc1' => 'Uno',
            'wdoc2' => 'Usuario',
            'wdoc3' => 'Master',    
            'cdocente' => '900000',
            'fono1' => '555-555-555',
            'fono2' => '333-333-333',
            'email1' => 'admin@gmail.com',
            'email2' => 'master@gmail.com',
            'whatsapp' => false
            ]);
        $users = User::where('id','>',1)->get();
        foreach ($users as $user) {
            factory(DataUser::class)->create([
                    'user_id' => $user->id,
                    'cdocente' => str_pad($user->id, 6, '0', STR_PAD_LEFT),
                    'email1' => $user->email,
                ]);    
        }
        
    }
}
