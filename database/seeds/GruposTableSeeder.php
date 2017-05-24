<?php
use App\Grupo;
use Illuminate\Database\Seeder;
class GruposTableSeeder extends Seeder
{
public function run(){
Grupo::create([
'id' => 1,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'AGP',
'wgrupo' => 'ADMINISTRACION Y GOB. PERSONAS',
]);
Grupo::create([
'id' => 2,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'APP',
'wgrupo' => 'ADMINISTRACION (PRACTICAS PRE)',
]);
Grupo::create([
'id' => 3,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'AUD',
'wgrupo' => 'AUDITORIA',
]);
Grupo::create([
'id' => 4,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'CAP',
'wgrupo' => 'CONTABILIDAD APLICADA',
]);
Grupo::create([
'id' => 5,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'CBA',
'wgrupo' => 'CONTABILIDAD BASICA',
]);
Grupo::create([
'id' => 6,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'CCO',
'wgrupo' => 'CONTABILIDAD DE COSTOS',
]);
Grupo::create([
'id' => 7,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'CSU',
'wgrupo' => 'CONTABILIDAD SUPERIOR',
]);
Grupo::create([
'id' => 8,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'DEC',
'wgrupo' => 'DECANATO',
]);
Grupo::create([
'id' => 9,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'DER',
'wgrupo' => 'DERECHO',
]);
Grupo::create([
'id' => 10,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'EBA',
'wgrupo' => 'ECONOMIA BASICA',
]);
Grupo::create([
'id' => 11,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'EDU',
'wgrupo' => 'FACULTAD DE EDUCACION',
]);
Grupo::create([
'id' => 12,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'EIN',
'wgrupo' => 'ECONOMIA INTERMEDIA',
]);
Grupo::create([
'id' => 13,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'EST',
'wgrupo' => 'ESTADISTICAS',
]);
Grupo::create([
'id' => 14,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'ESU',
'wgrupo' => 'ECONOMIA SUPERIOR',
]);
Grupo::create([
'id' => 15,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'FIN',
'wgrupo' => 'FINANZAS',
]);
Grupo::create([
'id' => 16,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'GES',
'wgrupo' => 'GESTION',
]);
Grupo::create([
'id' => 17,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'ING',
'wgrupo' => 'FACULTAD DE INGENIERIA',
]);
Grupo::create([
'id' => 18,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'INV',
'wgrupo' => 'INVESTIGACION Y PROYECTOS',
]);
Grupo::create([
'id' => 19,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'MAT',
'wgrupo' => 'MATEMATICAS',
]);
Grupo::create([
'id' => 20,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'MKT',
'wgrupo' => 'MARKETING',
]);
Grupo::create([
'id' => 21,
'facultad_id' => 1,
'sede_id' => 1,
'cgrupo' => 'OPE',
'wgrupo' => 'OPERACIONES',
]);
}
}
