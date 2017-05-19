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
			</tr>
			@endforeach
		</tbody>
	</table>
		
@endsection


@section('view','admin/user/index.blade.php')