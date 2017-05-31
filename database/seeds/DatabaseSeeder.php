<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DatausersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(FacultadesTableSeeder::class);
        $this->call(SedesTableSeeder::class);
        $this->call(AccesosTableSeeder::class);
        $this->call(SedeFacultadesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuTypeTableSeeder::class);
        $this->call(FranjasTableSeeder::class);
    //    $this->call(DHorasTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(GruposTableSeeder::class);
        $this->call(CursoGrupoTableSeeder::class);
    }
}
