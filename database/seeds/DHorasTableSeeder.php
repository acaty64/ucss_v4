<?php

use App\Acceso;
use App\DHora;
use Illuminate\Database\Seeder;

class DHorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accesos = Acceso::all();
        foreach ($accesos as $acceso) {
            DHora::create([
                'facultad_id' => $acceso->facultad_id,
                'sede_id' => $acceso->sede_id,
                'user_id' => $acceso->user_id,
                ]);
        }

        /* User 7: para tests*/
        $acceso = Acceso::where('user_id',7)->first();
        $acceso->facultad_id = 1;
        $acceso->sede_id = 1;
        $acceso->save;
    }

}
