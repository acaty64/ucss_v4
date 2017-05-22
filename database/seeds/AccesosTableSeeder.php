<?php

use App\Acceso;
use App\Facultad;
use App\Sede;
use App\Type;
use App\User;
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

        Acceso::create([
            'user_id' => 2,
            'facultad_id' => 1, 
            'sede_id' => 1,
            'type_id' => 5
            ]);

        Acceso::create([
            'user_id' => 3,
            'facultad_id' => 1, 
            'sede_id' => 1,
            'type_id' => 4
            ]);

        Acceso::create([
            'user_id' => 4,
            'facultad_id' => 1, 
            'sede_id' => 1,
            'type_id' => 3
            ]);

        Acceso::create([
            'user_id' => 5,
            'facultad_id' => 1, 
            'sede_id' => 1,
            'type_id' => 2
            ]);

        $users = User::where('id','>',5)->get();
        foreach ($users as $user) {
            $user_id = $user->id;
            $facultad_id = Facultad::all()->random()->id;
            $sede_id = Sede::all()->random()->id;
            $type_id = Type::all()->random()->id;
            Acceso::create([
               'user_id' => $user_id,
               'facultad_id' => $facultad_id, 
               'sede_id' => $sede_id,
               'type_id' => $type_id

                ]);
        }

        /* User 7: para tests*/
        $user = User::find(7);
        $user->facultad_id = 1;
        $user->sede_id = 1;
        $user->save;

    }
}
