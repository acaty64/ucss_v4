<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(['id' => 1, 'name' => 'Inicio', 'href' => 'home', 'sw_auth' => false, ]);
        Menu::create(['id' => 2, 'name' => 'Menus', 'href' => 'menu.index', 'sw_auth' => true, ]);
        Menu::create(['id' => 3, 'name' => 'Generar Menus', 'href' => 'menu.generar', 'sw_auth' => true, ]);
        Menu::create(['id' => 4, 'name' => 'Tipos de Usuarios', 'href' => 'type.index', 'sw_auth' => true, ]);
        Menu::create(['id' => 5, 'name' => 'Asignacion de Menus', 'href' => 'menutype.index', 'sw_auth' => true, ]);

        Menu::create(['id' => 6, 'name' => 'Lista de Usuarios', 'href' => 'user.index', 'sw_auth' => true, ]);

        Menu::create(['id' => 7, 'name' => 'Datos Personales', 'href' => 'datauser.edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);
        Menu::create(['id' => 8, 'name' => 'Disponibilidad', 'sw_auth' => false, ]);
        Menu::create(['id' => 9, 'name' => 'Días y Horas', 'href' => 'dhoras.edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);
        Menu::create(['id' => 10, 'name' => 'Cursos', 'href' => 'dcursos.edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);
        Menu::create(['id' => 11, 'name' => 'Carga Asignada', 'href' => 'horario.show', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);






        Menu::create(['id' => 12, 'name' => 'Prioridad Docentes', 'href' => 'grupocursos.index', 'sw_auth' => true, ]);

        Menu::create(['id' => 13, 'name' => 'Usuarios', 'href' => 'user.index', 'sw_auth' => true, ]);
        Menu::create(['id' => 14, 'name' => 'Grupos de Cursos', 'sw_auth' => false, ]);
        Menu::create(['id' => 15, 'name' => 'Grupos', 'href' => 'grupos.index', 'sw_auth' => true, ]);
        Menu::create(['id' => 16, 'name' => 'Responsables', 'href' => 'usergrupos.index', 'sw_auth' => true, ]);
        Menu::create(['id' => 17, 'name' => 'Verificaciones', 'sw_auth' => false, ]);
        Menu::create(['id' => 18, 'name' => 'Actualización de Disponibilidad Horaria', 'href' => 'dhoras.lista', 'sw_auth' => true, ]);
        Menu::create(['id' => 19, 'name' => 'Actualización de Disponibilidad de Cursos', 'href' => 'dcursos.lista', 'sw_auth' => true, ]);
        Menu::create(['id' => 20, 'name' => 'Acciones', 'sw_auth' => false, ]);
        Menu::create(['id' => 21, 'name' => 'Envío de Correos Electrónicos', 'href' => 'menvios.index', 'sw_auth' => true, ]);

    }

}
