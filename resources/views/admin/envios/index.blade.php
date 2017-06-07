@extends('template.main')

@section('title','Grupos de Envíos de Correos Electrónicos')

@section('content')
		<a href="{{ route('administrador.menvio.create') }}" class="btn btn-info">Crear nuevo grupo de envíos de correos electrónicos</a>
	<table class="table table-striped">
 		<thead>
 			<th>Id</th>
 			<th>Tipo</th>
 			<th>Fecha de envio</th>
 			<th>Fecha límite</th>
 			<th>Envíos</th>
 			<th>Respuestas</th>
 			<th>Acción</th>
 		</thead>
 		<tbody>
 			@foreach($Menvios as $envio )
 				<tr>
 					<td>{{ $envio->id }}</td>
 					<td>{{ $envio->tipo }}</td>
 					<td>{{ $envio->fenvio }}</td>
 					<td>{{ $envio->flimite }}</td>
 					<td>
 						 <span class="badge">{{ $envio->envio1 }}</span>
 						 @if($envio->tipo == 'disp')
 						 	<span class="badge">{{ $envio->envio2 }}</span>
 						 @endif
 					</td>
 					<td>
 						<span class="badge">{{ $envio->rpta1 }}</span>
 						@if($envio->tipo == 'disp')
 						 	<span class="badge">{{ $envio->rpta2 }}</span>
 						@endif
 					</td>
	 				<td>
	 					@if($envio->sw_envio == 0)
	 						<a href="{{ route('administrador.menvio.edit', $envio->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar envio"><span class="glyphicon glyphicon-wrench" aria-hidden='true' id="{{'Mody'.$envio->id}}"></span></a>
	 						<a href="{{ route('administrador.denvio.define', $envio->id ) }}" class="btn btn-success" data-toggle="tooltip" title="Agregar Docentes a Comunicar"><span class="glyphicon glyphicon-plus-sign" aria-hidden='true' id="{{'Add'.$envio->id}}"></span></a>
	 					@else
	 						<a href="{{ route('administrador.menvio.show', $envio->id ) }}" class="btn btn-primary" data-toggle="tooltip" title="Ver Docentes Comunicados"><span class="glyphicon glyphicon-eye-open" aria-hidden='true' id="{{'Show'.$envio->id}}"></span></a>
	 					@endif
	 					<a href="{{ route('administrador.menvio.destroy', $envio->id) }}" onclick="return confirm('Está seguro de eliminar este envio?')" class="btn btn-danger" data-toggle="tooltip" title="Eliminar envio" id="{{'Dele'.$envio->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>
	 					@if($envio->envio1 > 0 and $envio->sw_envio == 0)
	 						<a href="{{ route('administrador.envio.send', $envio->id) }}" class="btn btn-success" data-toggle="tooltip" title="Enviar los correos electrónicos"><span class="glyphicon glyphicon-send" aria-hidden='true' id="{{'Send'.$envio->id}}"></a>
	 					@endif
	 				</td>	
	 			</tr>
 			@endforeach 			
 		</tbody>
	</table>
	{!! $Menvios->render() !!}
@endsection

@section('view','admin/envios/index.blade.php')	