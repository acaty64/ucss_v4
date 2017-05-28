<?php

use App\Facultad;
use Illuminate\Database\Seeder;

class FacultadesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Facultad::create(['cFacultad' => 'FCEC', 'wFacultad' => 'Facultad de Ciencias Economicas y Comerciales']);
    Facultad::create(['cFacultad' => 'FCEH', 'wFacultad' => 'Facultad de Ciencias de la Educación y Humanidades']);
    Facultad::create(['cFacultad' => 'FING', 'wFacultad' => 'Facultad de Ingeniería']);
    Facultad::create(['cFacultad' => 'FSAL', 'wFacultad' => 'Facultad de Salud']);
    Facultad::create(['cFacultad' => 'FIA', 'wFacultad' => 'Facultad de Ingeniería Agraria']);
    Facultad::create(['cFacultad' => 'FDER', 'wFacultad' => 'Facultad de Derecho']);
	}
}
