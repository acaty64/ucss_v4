@extends('template.main')

@section('title','Franjas de la sede '.$wsede)

@section('content')
	<a href="{{ route('administrador.franja.create') }}" class="btn btn-info pull-left" id='NuevaFranja' name='NuevaFranja'>Crear Nueva Franja</a>
	<a href="{{ route('administrador.franja.show') }}" class="btn btn-info pull-right" id='ShowFranja' name='ShowFranja'>Ver Cuadro Franjas</a>
	<table class="table table-striped">
 		<thead>
 			<th>id</th>
 			<th>Día</th>
 			<th>Turno</th>
 			<th>Hora</th>
 			<th>Franja</th>
 		</thead>
 		<tbody>
 			@foreach($franjas as $franja)
 				<tr>
	 				<td>{{ $franja->id }}</td>
	 				<td>{{ $franja->dia }}</td>
	 				<td>{{ $franja->turno }}</td>
	 				<td>{{ $franja->hora }}</td>
	 				<td>{{ $franja->wfranja }}</td>
	 				<td>
	 					<a href="{{ route('admin.franja.edit', [$franja->id]) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar" name = "{{'Edit'.$franja->id}}"><span class="glyphicon glyphicon-pencil" aria-hidden='true'></span></a>

						<a href="{{ route('administrador.franja.destroy', $franja->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar franja" name = "{{'Dele'.$franja->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>

	 				</td>
	 			</tr>
 			@endforeach 			
 		</tbody>
	</table>
	{{ $franjas->links() }}

@endsection

@section('view','admin/franja/index.blade.php')