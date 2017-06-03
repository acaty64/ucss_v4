@extends('template.main')
@section('content')
<div class="panel panel-default" >
    <div class="panel-heading">Inicio - Descripción de Opciones</div>
    <div class="panel-body">
        <div class="conteiner" style="margin-top: 0px;">
            <ul class="nav nav-tabs">
                @if(Auth::user()->type == '01' or Auth::user()->type == '02' or Auth::user()->type == '03')
                    <li class="active"><a href="#datospersonales" data-toggle="tab">Datos Personales</a></li>
                @endif
                @if(Auth::user()->type == '02' or Auth::user()->type == '03')
                    <li><a href="#disponibilidad" data-toggle="tab">Disponibilidad</a></li>
                    <li><a href="#carga" data-toggle="tab">Carga Asignada</a></li>
                @endif
                @if(Auth::user()->type == '03')
                    <li><a href="#prioridad" data-toggle="tab">Prioridad Docentes</a></li>
                @endif
                @if(Auth::user()->type == '09')
                    <li class="active"><a href="#usuarios" data-toggle="tab">Usuarios</a></li>
                    <li><a href="#grupos" data-toggle="tab">Grupos</a></li>
                    <li><a href="#verificaciones" data-toggle="tab">Verificaciones</a></li>
                    <li><a href="#acciones" data-toggle="tab">Acciones</a></li>
                @endif
            </ul>        
        
            <div class="tab-content">
                @if(Auth::user()->type != '09')
                    <div class="tab-pane fade in active" id="datospersonales">
                        <h4>Datos Personales</h4>
                        En esta opción usted podrá modificar sus datos personales tales como números de celular o teléfono fijo, así como sus correos de contacto.
                    </div>
                    <div class="tab-pane fade" id="disponibilidad">
                        <h4>Disponibilidad</h4>
                        En esta opción deberá usted indicar las franjas horarias que dispone usted para ser programado por la facultad, así como los cursos que a su criterio podría dictar.
                        En caso que su disponibilidad, tanto horaria como de cursos, no se haya modificado, deberá confirmar su información grabándola en cada una de las opciones.
                        Esta opción puede ser consultada en cualquier momento, pero solo puede ser modificada previo requerimiento de la coordinación académica, enviada a su correo electrónico registrado en sus Datos Personales. 
                    </div>
                    <div class="tab-pane fade" id="carga">
                        <h4>Carga Asignada</h4>
                        En esta opción deberá confirmar la carga académica asignada en el presente semestre.
                    </div>
                    <div class="tab-pane fade" id="prioridad">
                        <h4>Prioridad Docentes - Solo responsables de Grupos Temáticos</h4>
                        En esta opción debe indicar a su criterio la priorización de docentes en cada uno de los cursos asignados.
                        Debe efectuar por lo menos una modificación para que se registre la actualización de la lista priorizada.
                    </div>
                @endif
                @if(Auth::user()->type == '09')
                    <div class="tab-pane fade in active" id="usuarios">
                        <h4>Usuarios</h4>
                        En esta opción obtendrá usted la lista de todos los docentes registrados, así como el acceso a la información de cada uno de ellos, tales como Datos personales, su Disponibilidad (Horaria y de Cursos) y su Carga asignada.
                        Creación, Modificación y Eliminación de cada una de las opciones.
                    </div>
                    <div class="tab-pane fade" id="grupos">
                        <h4>Grupos</h4>
                        En esta opción obtendrá usted la lista de todos los grupos temáticos registrados, así como el acceso a la información de cada uno de ellos, tales como Responsables, Cursos Relacionados y Prioridad de Docentes de cada curso.
                    </div>
                    <div class="tab-pane fade" id="verificaciones">
                        <h4>Verificaciones</h4>
                        En esta opción obtendrá usted la lista de los docentes informados, que han actualizado la información requerida y los que no han accedido a actualizarla.
                    </div>
                    <div class="tab-pane fade" id="acciones">
                        <h4>Acciones</h4>
                        En esta opción podrá realizar los procesos de envíos de correos electrónicos a los docentes activos para el requerimiento de información.
                        Además, podrá ejecutar la importación o exportación de información como interfase al sistema de programación en VFP.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('view','main.blade.php')