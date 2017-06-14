@extends('template.main')
 
@section('title','Lista de Actualizaciones de Horarios Disponibles')

@section('content')
	<a href="{{ route('admin.dhora.list2Excel') }}" class="btn btn-info">Exportar a Excel</a>
	<table class="table table-striped">
 		<thead>
 			<th>Tipo</th>
 			<th>Docente</th>
 			<th>Envio</th>
 			<th>Limite</th>
 			<th>Actualizacion</th>
 			<th>Status</th>
 		</thead>
 		<tbody>
 			@foreach($lista as $registro)
 				<tr>
 					<td>{{$registro['type']}}</td>
					<td>{{substr($registro['wdocente'],0,50)}}</td>
					<td>{{$registro['fenvio']}}</td>
					<td>{{$registro['flimite']}}</td>
					<td>{{$registro['updated_at']}}</td>
					<td>{{$registro['sw_actualizacion']}}</td>
	 			</tr>
 			@endforeach
 		</tbody>
	</table>
@endsection

@section('view','admin/dhoras/list.blade.php')
