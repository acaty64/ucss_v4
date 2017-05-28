@extends('template.main')

@section('title','Lista de Usuarios: '.$title)

@section('content')
	@if('can:is_master')
		<a href="{{ route('admin.user.create') }}" class="btn btn-info" id='NuevoUsuario' name='NuevoUsuario'>Registrar Nuevo Usuario</a>
	@endif
	<!-- INICIO DEL BUSCADOR  -->
		{!! Form::open(['route' => 'administrador.user.index', 'method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
			<div class="form-group">
				{!! Form::select('type', $types, null,['placeholder'=>'Tipo']) !!}
			</div>
			<div class="input-group">
				{!! Form::text('wdocente', null, ['class'=>'form-control', 'placeholder'=>'Buscar docente...', 'aria-describedby'=>'search']) !!}
				<span class="input-group-addon" id='search'><span class="glyphicon glyphicon-search" "aria-hidden"="true"></span></span>
			</div>
		{!! Form::close() !!}
<table class="table table-striped">
	<thead>
 			<th>id</th>
 			<th>Código</th>
 			<th>Usuario</th>
 			<th>Docente</th>
 			<th>Tipo</th>
 			<th>Acción</th>
 		</thead>
 		<tbody> 
			@foreach($users as $user)
				<tr>
					<td>{{$user->user_id}}</td>
					<td>{{$user->cdocente}}</td>
					<td>{{$user->user->name}}</td>
					<td>{{$user->wdocente}}</td>
					<td>{{$user->ctype}}</td>
					<td>
						@if('can:is_master')
							<a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar usuario" name = "{{'Mody'.$user->id}}"><span class="glyphicon glyphicon-wrench" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.user.editpass', $user->id) }}" class="btn btn-danger" data-toggle="tooltip" title="Modificar password" name = "{{'EditPass'.$user->id}}"><span class="glyphicon glyphicon-lock" aria-hidden='true'></span></a>
		 					
		 					<a href="{{ route('admin.user.destroy', $user->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar usuario" name = "{{'Dele'.$user->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>

		 					<a href="{{ route('admin.datauser.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar datos usuario" name = "{{'EditData'.$user->id}}"><span class="glyphicon glyphicon-earphone" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.dhora.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad Horaria" name = "{{'Dhora'.$user->id}}"><span class="glyphicon glyphicon-calendar" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.dcurso.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad de Cursos" name = "{{'Dcurso'.$user->id}}"><span class="glyphicon glyphicon-list-alt" aria-hidden='true'></span></a>

						@endif


					</td>
				</tr>
			@endforeach
		</tbody>
</table>

@endsection


@section('view','master/user/index.blade.php')