<?php

use App\Acceso;
use Illuminate\Database\Seeder;

class AccesosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Acceso::create([
            'user_id' => 1,
            'facultad_id' => 1, 
            'sede_id' => 1,
            'type_id' => 1
            ]);
    }
}
