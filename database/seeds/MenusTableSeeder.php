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
Menu::create(['id' => 1, 'name' => 'Inicio', 'href' => 'home', 'sw_auth' => false, 'help' => 'Regresa a definir facultad y sede a acceder.', ]);
Menu::create(['id' => 2, 'name' => 'Menus', 'href' => 'menu/index', 'sw_auth' => true, 'help' => 'Definición de opciones de menues.', ]);
Menu::create(['id' => 3, 'name' => 'Generar', 'sw_auth' => false, 'help' => 'Generar archivos de Navegación y Ayuda.', ]);
Menu::create(['id' => 4, 'name' => 'Generar Menus', 'href' => 'menu/generar', 'sw_auth' => true, ]);
Menu::create(['id' => 5, 'name' => 'Generar Ayuda', 'href' => 'menu/generarhelp', 'sw_auth' => true, ]);
Menu::create(['id' => 6, 'name' => 'Tipos de Usuarios', 'href' => 'type/index', 'sw_auth' => true, 'help' => 'CRUD Tipo de usuario.', ]);
Menu::create(['id' => 7, 'name' => 'Asignacion de Menus', 'href' => 'menutype/index', 'sw_auth' => true, 'help' => 'Asignación de opciones de menú a Tipo de Usuario.', ]);

Menu::create(['id' => 8, 'name' => 'Lista de Usuarios', 'href' => 'user/index', 'sw_auth' => true, 'help' => 'Lista de todos los usuarios de la facultad y sede seleccionada.', ]);

Menu::create(['id' => 9, 'name' => 'Datos Personales', 'href' => 'datauser/edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', 'help' => 'En esta opción usted podrá modificar sus datos personales tales como números de celular o teléfono fijo, así como sus correos de contacto.', ]);
Menu::create(['id' => 10, 'name' => 'Disponibilidad', 'sw_auth' => false, 'help' => 'En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
Esta opción puede ser consultada en cualquier momento, pero solo puede ser modificada previo requerimiento de la coordinación académica, enviada a su correo electrónico registrado en sus Datos Personales.', ]);
Menu::create(['id' => 11, 'name' => 'Días y Horas', 'href' => 'dhora/edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);
Menu::create(['id' => 12, 'name' => 'Cursos', 'href' => 'dcurso/edit', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', ]);
Menu::create(['id' => 13, 'name' => 'Carga Asignada', 'href' => 'horario/show', 'sw_auth' => true, 'parameter' => 'Auth::user()->id', 'help' => 'En esta opción deberá confirmar la carga académica asignada en el presente semestre.', ]);






Menu::create(['id' => 14, 'name' => 'Prioridad Docentes', 'href' => 'grupocurso/index', 'sw_auth' => true, 'help' => 'En esta opción debe indicar a su criterio la priorización de docentes en cada uno de los cursos asignados.
Debe efectuar por lo menos una modificación para que se registre la actualización de la lista priorizada.', ]);

Menu::create(['id' => 15, 'name' => 'Usuarios', 'href' => 'user/index', 'sw_auth' => true, 'help' => 'En esta opción obtendrá usted la lista de todos los docentes registrados, así como el acceso a la información de cada uno de ellos, tales como Datos personales, su Disponibilidad (Horaria y de Cursos) y su Carga asignada.
Creación, Modificación y Eliminación de cada una de las opciones.', ]);
Menu::create(['id' => 16, 'name' => 'Grupos de Cursos', 'sw_auth' => false, 'help' => 'En esta opción obtendrá usted la lista de todos los grupos temáticos registrados, así como el acceso a la información de cada uno de ellos, tales como Responsables, Cursos Relacionados y Prioridad de Docentes de cada curso.', ]);
Menu::create(['id' => 17, 'name' => 'Grupos', 'href' => 'grupo/index', 'sw_auth' => true, ]);
Menu::create(['id' => 18, 'name' => 'Responsables', 'href' => 'usergrupo/index', 'sw_auth' => true, ]);
Menu::create(['id' => 19, 'name' => 'Verificaciones', 'sw_auth' => false, 'help' => 'En esta opción obtendrá usted la lista de los docentes informados, que han actualizado la información requerida y los que no han accedido a actualizarla.', ]);
Menu::create(['id' => 20, 'name' => 'Actualización de Disponibilidad Horaria', 'href' => 'dhora/lista', 'sw_auth' => true, ]);
Menu::create(['id' => 21, 'name' => 'Actualización de Disponibilidad de Cursos', 'href' => 'dcurso/lista', 'sw_auth' => true, ]);
Menu::create(['id' => 22, 'name' => 'Acciones', 'sw_auth' => false, 'help' => 'En esta opción podrá realizar los procesos de envíos de correos electrónicos a los docentes activos para el requerimiento de información.', ]);
Menu::create(['id' => 23, 'name' => 'Envío de Correos Electrónicos', 'href' => 'menvio/index', 'sw_auth' => true, 'help' => 'En esta opción podrá realizar los procesos de envíos de correos electrónicos a los docentes activos para el requerimiento de información.', ]);


    }

}
