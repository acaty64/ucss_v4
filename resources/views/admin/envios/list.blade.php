@extends('template.main')

@section('title','Lista de Docentes Comunicados. / Tipo: '
		. $Denvios[0]->menvio->tipo
		. ' / Fecha de Envío: ' . $Denvios[0]->menvio->fenvio
		. ' / Fecha Límite: ' . $Denvios[0]->menvio->flimite )

@section('content')

	<table class="table table-striped">
 		<thead>
 			<th>Id</th>
 			<th>Codigo</th>
 			<th>Docente Comunicado</th>
 			<th>Email enviado</th>
 			<th>Email con copia</th>
 			<th>Enviado</th>
 			<th>Respuesta</th>
 		</thead>
 		<tbody>
 			@foreach($Denvios as $envio )
 				<tr>
 					<td>{{ $envio->id }}</td>
 					<td>{{ $envio->user->username }}</td>
 					<td>{{ substr($envio->user->wdocente($envio->user_id),0,50) }}</td>
 					<td>{{ $envio->email_to }}</td>
 					<td>{{ $envio->email_cc }}</td>
 					<td>
 						@if($envio->sw_envio == 1)
 							<a href="#" class="btn btn-success" data-toggle="tooltip" title="Se envió"><span class="glyphicon glyphicon-ok" aria-hidden='true'></span></a>
 						@else
 							<a href="#" class="btn btn-danger" data-toggle="tooltip" title="Está pendiente de envío"><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
 						@endif

 					</td>
 					<td>
 						@if($envio->sw_rpta == 1)
 							<a href="#" class="btn btn-success" data-toggle="tooltip" title="El docente respondió"><span class="glyphicon glyphicon-ok" aria-hidden='true'></span></a>
 						@else
 							<a href="#" class="btn btn-danger" data-toggle="tooltip" title="El docente no ha respondido"><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
 						@endif

 					</td>
	 			</tr>
 			@endforeach 			
 		</tbody>
	</table>
	{!! $Denvios->render() !!}
@endsection

@section('view','admin/envios/list.blade.php')	
