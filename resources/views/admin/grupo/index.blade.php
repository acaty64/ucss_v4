@extends('template.main')

@section('title','Indice de Grupos')

@section('content')
	@can('is_admin', $acceso_auth)
		<a href="{{ route('admin.grupo.create') }}" class="btn btn-info" id='NuevoGrupo' name='NuevoGrupo'>Registrar Nuevo Grupo</a>
	@endcan
	<table class="table table-striped table-condensed table-hover">
		<thead>
 			<th>id</th>
 			<th>Código</th>
 			<th>Grupo</th>
 			<th>Acción</th>
 		</thead>
 		<tbody> 
			@foreach($grupos as $grupo)
				<tr>
					<td>{{$grupo->id}}</td>
					<td>{{$grupo->cgrupo}}</td>
					<td>{{$grupo->wgrupo}}</td>
					<td>
						@can('is_consulta', $acceso_auth)
							<a href="{{ route('consulta.grupo.show', $grupo->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Ver Cursos del Grupo" name = "{{'Show'.$grupo->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden='true'></span></a>
						@endcan
						@can('is_admin', $acceso_auth)
							<a href="{{ route('admin.grupo.edit', $grupo->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar grupo" name = "{{'Mody'.$grupo->id}}"><span class="glyphicon glyphicon-wrench" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.cursogrupo.index', $grupo->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar prioridad" name = "{{'EditOrden'.$grupo->id}}"><span class="glyphicon glyphicon-sort" aria-hidden='true'></span></a>
		 					
		 					<a href="{{ route('admin.grupo.destroy', $grupo->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar grupo" name = "{{'Dele'.$grupo->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('view','admin/grupo/index.blade.php')