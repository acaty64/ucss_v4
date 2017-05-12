<?php

use App\Sede;
use Illuminate\Database\Seeder;

class SedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sede::create(
        	['cSede' => 'LIM', 'wSede' => 'Lima']);
        Sede::create(
        	['cSede' => 'HUA', 'wSede' => 'Huacho']);
        Sede::create(
        	['cSede' => 'NCA', 'wSede' => 'Nueva Cajamarca']);
        Sede::create(
        	['cSede' => 'ATA', 'wSede' => 'Atalaya']);
        Sede::create(
        	['cSede' => 'TAR', 'wSede' => 'Tarma']);
        Sede::create(
        	['cSede' => 'CHU', 'wSede' => 'Chulucanas']);
    }
}
