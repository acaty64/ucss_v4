@extends('template.main')

@section('title','Lista de Docentes a Comunicar. / Tipo: '
		. $denvios[0]->menvio->tipo
		. ' / Fecha de Envío: ' . $denvios[0]->menvio->fenvio
		. ' / Fecha Límite: ' . $denvios[0]->menvio->flimite )

@section('content')
	<table>
		<tbody>
			<tr>
				<td style="width:30%">
					<a href="{{ route('administrador.denvio.markall', $denvios[0]->menvio->id) }}" class="btn btn-success" data-toggle="tooltip" title="Marcar todos"><span class="glyphicon glyphicon-check" aria-hidden='true' id='markall'> Marcar Todos</span></a>
					</td>
				<td style="width:30%">
					<a href="{{ route('administrador.denvio.unmarkall', $denvios[0]->menvio->id ) }}" class="btn btn-info" data-toggle="tooltip" title="Desmarcar todos"><span class="glyphicon glyphicon-unchecked" aria-hidden='true' id='unmarkall'> Desmarcar Todos</span></a>
					</td>
				<td style="width:30%">
					{!! Form::model($denvios, array('route' => array('administrador.denvio.update'), 'method' => 'PUT')) !!}
					{!! Form::submit('Grabar cambios de la página', ['class'=>'btn btn-primary', 'id'=>'Grabar']) !!}</td>
				<td style="width:30%">
					<a href="{{ route('administrador.menvio.index') }}" class="btn btn-success" data-toggle="tooltip" title="Regresar al índice" id='Regresar'><span class="glyphicon glyphicon-menu-right" aria-hidden='true'> Regresar al índice</span></a>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped">
 		<thead>
 			<th>User Id</th>
 			<th>Código</th>
 			<th>Docente a Comunicar</th>
 			<th>Email principal</th>
 			<th>Email alternativo</th>
 			<th>Enviar</th>
 		</thead>
 		<tbody>
 			{!! Form::hidden('tipo', $denvios[0]->menvio->tipo) !!}
 			@foreach($denvios as $envio )
 				<tr>
 					<td>{{ $envio->user_id }}</td>
 					<td>{{ $envio->cdocente }}</td>
 					<td>{{ substr($envio->wdocente,0,40) }}</td>
 					<td>{{ $envio->email_to }}</td>
 					<td>{{ $envio->email_cc }}</td>
 					<td>
 						{{ Form::hidden('xenvios['.$envio->id.']->sw_envio', 0) }}	
						@if($envio->sw_envio == 1)	
							{!! Form::checkbox('xenvios['.$envio->id.']->sw_envio', 1, true , ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);', 'id'=>"check".$envio->user->id] ) !!}
						@else	
							{!! Form::checkbox('xenvios['.$envio->id.']->sw_envio', 0, false, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);', 'id'=>"check".$envio->user->id] ) !!}
						@endif	
 					</td>
 					
	 			</tr>
 			@endforeach 			
 		</tbody>
 		{!! Form::close() !!}
	</table>	
	{!! $denvios->render() !!}
@endsection

@section('js')			
	<script type="text/javascript">			
		function evento($obj){		
			//console.log($obj);	
			if($obj.checked)	
				$obj.value = 1;
			else	
				$obj.value = 0;
		}
	
	</script>			
@endsection		

@section('view','admin/envios/define.blade.php')	

