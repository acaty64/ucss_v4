<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    public function run()
    {
        Type::create(['id' => 1, 'name' =>'Master', ]);
        Type::create(['id' => 2, 'name' =>'Consulta', ]);
        Type::create(['id' => 3, 'name' =>'Docente', ]);
        Type::create(['id' => 4, 'name' =>'Responsable', ]);
        Type::create(['id' => 5, 'name' =>'Administrador', ]);
    }
}
