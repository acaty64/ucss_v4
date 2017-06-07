@extends('template.main')

@section('title','Lista de Usuarios: '.$title)

@section('content')
	@can('is_admin', $acceso_auth)
		<a href="{{ route('admin.user.create') }}" class="btn btn-info" id='NuevoUsuario' name='NuevoUsuario'>Registrar Nuevo Usuario</a>
	@endcan
	<!-- INICIO DEL BUSCADOR  -->
		{!! Form::open(['route' => strtolower(Session::get('ctype')) . ".user.index", 'method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
			<span>
				{!! Form::select('type', $types, null,['placeholder'=>'Tipo', 'class'=>'chosen']) !!}
			</span>
			<span class="input-group">
				{!! Form::text('wdocente', null, ['class'=>'form-control', 'placeholder'=>'Buscar docente...', 'aria-describedby'=>'search']) !!}
				<span class="input-group-addon" id='search'><button type='submit' class="glyphicon glyphicon-search""aria-hidden"="true"></button></span>
			</span>
		{!! Form::close() !!}
<table class="table table-striped table-condensed table-hover">
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
				@if($user->ctype != "Master")
					<tr>
						<td>{{$user->user_id}}</td>
						<td>{{$user->cdocente}}</td>
						<td>{{$user->user->name}}</td>
						<td>{{$user->wdocente}}</td>
						<td>{{$user->ctype}}</td>
						<td>
							@can('is_consulta', $acceso_auth)
								<a href="{{ route('consulta.datauser.show', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Ver Datos Personales" name = "{{'Show'.$user->id}}"><span class="glyphicon glyphicon-user" aria-hidden='true'></span></a>
							@endcan
							@can('is_admin', $acceso_auth)
								<a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar usuario" name = "{{'Mody'.$user->id}}"><span class="glyphicon glyphicon-user" aria-hidden='true'></span></a>

			 					<a href="{{ route('admin.user.editpass', $user->id) }}" class="btn btn-danger" data-toggle="tooltip" title="Modificar password" name = "{{'EditPass'.$user->id}}"><span class="glyphicon glyphicon-lock" aria-hidden='true'></span></a>
			 					
			 					<a href="{{ route('admin.user.destroy', $user->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar usuario" name = "{{'Dele'.$user->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>

			 					<a href="{{ route('admin.acceso.edit', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar acceso del usuario" name = "{{'Acceso'.$user->id}}"><span class="glyphicon glyphicon-ok" aria-hidden='true'></span></a>

			 					<a href="{{ route('admin.datauser.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar datos usuario" name = "{{'EditData'.$user->id}}"><span class="glyphicon glyphicon-earphone" aria-hidden='true'></span></a>
								@if($user->ctype != 'Consulta')
				 					<a href="{{ route('admin.dhora.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad Horaria" name = "{{'Dhora'.$user->id}}"><span class="glyphicon glyphicon-calendar" aria-hidden='true'></span></a>

				 					<a href="{{ route('admin.dcurso.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad de Cursos" name = "{{'Dcurso'.$user->id}}"><span class="glyphicon glyphicon-list-alt" aria-hidden='true'></span></a>
				 				@endif
							@endcan
						</td>
					</tr>
				@endif
			@endforeach
		</tbody>
</table>
{!! $users->render() !!}
@endsection

@section('js')
	<script>
		$(".chosen").chosen({allow_single_deselect: true, disable_search: true});
	</script>

@endsection
@section('view','admin/user/index.blade.php')