@extends('template.main')

@section('title','Prioridad de Docentes del curso '.$curso->wcurso)

@section('content')
		<a href="{{ route('admin.cursogrupo.index',$grupo_id)}}" class="btn btn-info">Regresar al índice</a>
	<table class="table table-striped">
 		<thead>
 			<th>id</th>
 			<th>prioridad</th>
 			<th>Docente</th>
 		</thead>
 		<tbody>
 			@foreach($lista as $item)
 				<tr>
	 				<td>{{ $item['id'] }}</td>
	 				<td>{{ $item['prioridad'] }}</td>
	 				<td>{{ $item['name'] }}</td>
	 				<td>
	 					@if($item['prioridad']>1)
							<a href="{{ route('admin.dcurso.up', [ $grupo_id, $item['id']]) }}" name='up{{$item['id']}}' class="btn btn-success" data-toggle="tooltip" title="Subir"><span class="glyphicon glyphicon-menu-up" aria-hidden='true'></span></a>
						@else
							<a href='#' class="btn btn-success" data-toggle="tooltip" title="No se puede subir"><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
						@endif
						@if($item['prioridad'] < count($lista))
							<a href="{{ route('admin.dcurso.down', [$grupo_id, $item['id']]) }}" name='down{{$item['id']}}' class="btn btn-danger" data-toggle="tooltip" title="Bajar"><span class="glyphicon glyphicon-menu-down" aria-hidden='true'></span></a>
						@else
							<a href='#' class="btn btn-danger" data-toggle="tooltip" title="No se puede bajar"><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
						@endif
	 				</td>
	 			</tr>
 			@endforeach
 			
 		</tbody>
	</table>
@endsection

@section('view','admin/dcurso/orden.blade.php')