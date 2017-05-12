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
        Menu::create(['id' => 1, 'name' => 'Inicio', 'href' => '/home', ]);
        Menu::create(['id' => 2, 'name' => 'Menus', 'href' => '/master/menu/index', ]);
        Menu::create(['id' => 3, 'name' => 'Tipos de Usuarios', 'href' => '/master/type/index', ]);
        Menu::create(['id' => 4, 'name' => 'Asignacion de Menus', 'href' => '/master/menutype/index', ]);
        Menu::create(['id' => 5, 'name' => 'Datos Personales', 'href' => '/admin/user/index', ]);
        Menu::create(['id' => 6, 'name' => 'Disponibilidad', ]);
        Menu::create(['id' => 7, 'name' => 'Días y Horas', 'href' => '/admin/dhoras/edit', ]);
        Menu::create(['id' => 8, 'name' => 'Cursos', 'href' => '/admin/dcursos/edit', ]);
        Menu::create(['id' => 9, 'name' => 'Carga Asignada', 'href' => '/admin/horario/show', ]);
        Menu::create(['id' => 10, 'name' => 'Prioridad Docentes', 'href' => '/admin/grupocursos/index', ]);
        Menu::create(['id' => 11, 'name' => 'Usuarios', 'href' => '/admin/user/index', ]);
        Menu::create(['id' => 12, 'name' => 'Grupos de Cursos', ]);
        Menu::create(['id' => 13, 'name' => 'Grupos', 'href' => '/admin/grupos/index', ]);
        Menu::create(['id' => 14, 'name' => 'Responsables', 'href' => '/admin/usergrupos/index', ]);
        Menu::create(['id' => 15, 'name' => 'Verificaciones', ]);
        Menu::create(['id' => 16, 'name' => 'Actualización de Disponibilidad Horaria', 'href' => '/admin/dhoras/lista', ]);
        Menu::create(['id' => 17, 'name' => 'Actualización de Disponibilidad de Cursos', 'href' => '/admin/dcursos/lista', ]);
        Menu::create(['id' => 18, 'name' => 'Acciones', ]);
        Menu::create(['id' => 19, 'name' => 'Envío de Correos Electrónicos', 'href' => '/admin/menvios/index', ]);
    }

}
