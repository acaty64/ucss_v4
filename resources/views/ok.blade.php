@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-heading">Descripción de Opciones</div>
<div class="panel-body">
<div class="conteiner" style="margin-top: 0px;">
<ul class="nav nav-tabs">
@if(Session::get('ctype')=='Master')
<li class='active'><a href='#inicio' data-toggle='tab'>Inicio</a></li>
<li ><a href='#menus' data-toggle='tab'>Menus</a></li>
<li ><a href='#generar' data-toggle='tab'>Generar</a></li>
<li ><a href='#tiposdeusuarios' data-toggle='tab'>Tipos de Usuarios</a></li>
<li ><a href='#asignaciondemenus' data-toggle='tab'>Asignacion de Menus</a></li>
</ul>
<div class="tab-content">
<div class='tab-pane fade  in active' id='inicio'>
<h4>Inicio</h4>
Regresa a definir facultad y sede a acceder.
</div>
<div class='tab-pane fade ' id='menus'>
<h4>Menus</h4>
Definición de opciones de menues.
</div>
<div class='tab-pane fade ' id='generar'>
<h4>Generar</h4>
Generar archivos de Navegación y Ayuda.
</div>
<div class='tab-pane fade ' id='tiposdeusuarios'>
<h4>Tipos de Usuarios</h4>
CRUD Tipo de usuario.
</div>
<div class='tab-pane fade ' id='asignaciondemenus'>
<h4>Asignacion de Menus</h4>
Asignación de opciones de menú a Tipo de Usuario.
</div>
@endif
@if(Session::get('ctype')=='Consulta')
<li class='active'><a href='#inicio' data-toggle='tab'>Inicio</a></li>
<li ><a href='#listadeusuarios' data-toggle='tab'>Lista de Usuarios</a></li>
</ul>
<div class="tab-content">
<div class='tab-pane fade  in active' id='inicio'>
<h4>Inicio</h4>
Regresa a definir facultad y sede a acceder.
</div>
<div class='tab-pane fade ' id='listadeusuarios'>
<h4>Lista de Usuarios</h4>
Lista de todos los usuarios de la facultad y sede seleccionada.
</div>
@endif
@if(Session::get('ctype')=='Docente')
<li class='active'><a href='#inicio' data-toggle='tab'>Inicio</a></li>
<li ><a href='#datospersonales' data-toggle='tab'>Datos Personales</a></li>
<li ><a href='#disponibilidad' data-toggle='tab'>Disponibilidad</a></li>
<li ><a href='#cargaasignada' data-toggle='tab'>Carga Asignada</a></li>
</ul>
<div class="tab-content">
<div class='tab-pane fade  in active' id='inicio'>
<h4>Inicio</h4>
Regresa a definir facultad y sede a acceder.
</div>
<div class='tab-pane fade ' id='datospersonales'>
<h4>Datos Personales</h4>
En esta opción usted podrá modificar sus datos personales tales como números de celular o teléfono fijo, así como sus correos de contacto.
</div>
<div class='tab-pane fade ' id='disponibilidad'>
<h4>Disponibilidad</h4>
En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
Esta opción puede ser consultada en cualquier momento, pero solo puede ser modificada previo requerimiento de la coordinación académica, enviada a su correo electrónico registrado en sus Datos Personales.
</div>
<div class='tab-pane fade ' id='cargaasignada'>
<h4>Carga Asignada</h4>
En esta opción deberá confirmar la carga académica asignada en el presente semestre.
</div>
@endif
@if(Session::get('ctype')=='Responsable')
<li class='active'><a href='#inicio' data-toggle='tab'>Inicio</a></li>
<li ><a href='#datospersonales' data-toggle='tab'>Datos Personales</a></li>
<li ><a href='#disponibilidad' data-toggle='tab'>Disponibilidad</a></li>
<li ><a href='#cargaasignada' data-toggle='tab'>Carga Asignada</a></li>
<li ><a href='#prioridaddocentes' data-toggle='tab'>Prioridad Docentes</a></li>
</ul>
<div class="tab-content">
<div class='tab-pane fade  in active' id='inicio'>
<h4>Inicio</h4>
Regresa a definir facultad y sede a acceder.
</div>
<div class='tab-pane fade ' id='datospersonales'>
<h4>Datos Personales</h4>
En esta opción usted podrá modificar sus datos personales tales como números de celular o teléfono fijo, así como sus correos de contacto.
</div>
<div class='tab-pane fade ' id='disponibilidad'>
<h4>Disponibilidad</h4>
En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
Esta opción puede ser consultada en cualquier momento, pero solo puede ser modificada previo requerimiento de la coordinación académica, enviada a su correo electrónico registrado en sus Datos Personales.
</div>
<div class='tab-pane fade ' id='cargaasignada'>
<h4>Carga Asignada</h4>
En esta opción deberá confirmar la carga académica asignada en el presente semestre.
</div>
<div class='tab-pane fade ' id='prioridaddocentes'>
<h4>Prioridad Docentes</h4>
En esta opción debe indicar a su criterio la priorización de docentes en cada uno de los cursos asignados.
Debe efectuar por lo menos una modificación para que se registre la actualización de la lista priorizada.
</div>
@endif
@if(Session::get('ctype')=='Administrador')
<li class='active'><a href='#inicio' data-toggle='tab'>Inicio</a></li>
<li ><a href='#usuarios' data-toggle='tab'>Usuarios</a></li>
<li ><a href='#gruposdecursos' data-toggle='tab'>Grupos de Cursos</a></li>
<li ><a href='#verificaciones' data-toggle='tab'>Verificaciones</a></li>
<li ><a href='#acciones' data-toggle='tab'>Acciones</a></li>
</ul>
<div class="tab-content">
<div class='tab-pane fade  in active' id='inicio'>
<h4>Inicio</h4>
Regresa a definir facultad y sede a acceder.
</div>
<div class='tab-pane fade ' id='usuarios'>
<h4>Usuarios</h4>
En esta opción obtendrá usted la lista de todos los docentes registrados, así como el acceso a la información de cada uno de ellos, tales como Datos personales, su Disponibilidad (Horaria y de Cursos) y su Carga asignada.
Creación, Modificación y Eliminación de cada una de las opciones.
</div>
<div class='tab-pane fade ' id='gruposdecursos'>
<h4>Grupos de Cursos</h4>
En esta opción obtendrá usted la lista de todos los grupos temáticos registrados, así como el acceso a la información de cada uno de ellos, tales como Responsables, Cursos Relacionados y Prioridad de Docentes de cada curso.
</div>
<div class='tab-pane fade ' id='verificaciones'>
<h4>Verificaciones</h4>
En esta opción obtendrá usted la lista de los docentes informados, que han actualizado la información requerida y los que no han accedido a actualizarla.
</div>
<div class='tab-pane fade ' id='acciones'>
<h4>Acciones</h4>
En esta opción podrá realizar los procesos de envíos de correos electrónicos a los docentes activos para el requerimiento de información.
</div>
@endif
</div>
</div>
</div>
</div>
</div>
@endsection
