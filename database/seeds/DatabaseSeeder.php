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
        $this->call(AccesosTableSeeder::class);
        $this->call(SedesTableSeeder::class);
        $this->call(FacultadesTableSeeder::class);
        $this->call(SedeFacultadesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(MenuTypeTableSeeder::class);
    }
}
