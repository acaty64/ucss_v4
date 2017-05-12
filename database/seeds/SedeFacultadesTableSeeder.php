<?php

use App\Facultad;
use App\Sede;
use App\SedeFacultad;
use Illuminate\Database\Seeder;

class SedeFacultadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultad = 'FCEC';
        $sedes = ['LIM','HUA','NCA', 'ATA', 'CHU'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }
        /****************************/
        $facultad = 'FCEH';
        $sedes = ['LIM','HUA','NCA', 'ATA', 'TAR', 'CHU'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }
        /****************************/
        $facultad = 'FIA';
        $sedes = ['LIM','HUA','NCA', 'ATA', 'TAR', 'CHU'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }
        /****************************/
        $facultad = 'FING';
        $sedes = ['LIM', 'NCA', 'TAR'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }
        /****************************/
        $facultad = 'FSAL';
        $sedes = ['LIM', 'NCA', 'TAR', 'CHU'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }
        /****************************/
        $facultad = 'FDER';
        $sedes = ['LIM', 'NCA'];
        $facultad_id = Facultad::where('cfacultad', $facultad)->first()->id;
        foreach ($sedes as $sede) {
            $sede_id = Sede::where('csede', $sede)->first()->id;
            SedeFacultad::create(
            ['Sede_id' => $sede_id, 'Facultad_id' => $facultad_id]);
        }


    }
}
