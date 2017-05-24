@extends('template.main')

@section('title','Lista de Usuarios: '.$title)

@section('content')
	<table class="table table-striped">
		<caption>table title and/or explanatory text</caption>
		<thead>
			<tr>
				<th>id</th>
	 			<th>Código</th>
	 			<th>Docente</th>
	 			<th>Tipo</th>
	 			<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{$user->user_id}}</td>
				<td>'ERROR $user->cdocente}}'</td>
				<td>'ERROR $user->wdocente}}'</td>
				<td>{{$user->ctype}}</td>
				<td>
					<a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar usuario" name = "{{'Mody'.$user->username}}"><span class="glyphicon glyphicon-wrench" aria-hidden='true'></span></a>
					
 					<a href="{{ route('admin.user.destroy', $user->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar usuario" name = "{{'Dele'.$user->username}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>

 					<a href="{{ route('admin.datauser.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar datos usuario" name = "{{'EditData'.$user->username}}"><span class="glyphicon glyphicon-earphone" aria-hidden='true'></span></a>

 					<a href="{{ route('admin.dhora.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad Horaria" name = "{{'Dhora'.$user->username}}"><span class="glyphicon glyphicon-calendar" aria-hidden='true'></span></a>

 					<a href="{{ route('admin.dcurso.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad de Cursos" name = "{{'Dcurso'.$user->username}}"><span class="glyphicon glyphicon-list-alt" aria-hidden='true'></span></a>
				</td>


			</tr>
			@endforeach
		</tbody>
	</table>
		
@endsection


@section('view','admin/user/preindex.blade.php')