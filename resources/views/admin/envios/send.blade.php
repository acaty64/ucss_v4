@extends('template.main')

@section('title','admin/envios/send.blade.php Lista de Docentes a Comunicar. / Tipo: '
		. $denvios[0]->menvio->tipo
		. ' / Fecha de Envío: ' . $denvios[0]->menvio->fenvio
		. ' / Fecha Límite: ' . $denvios[0]->menvio->flimite )

@section('content')
	<table>
		<tbody>
			<tr>
				<td style="width:30%">
					<a href="{{ route('admin.menvios.dmarkall', $denvios[0]->menvio->id) }}" class="btn btn-success" data-toggle="tooltip" title="Marcar todos"><span class="glyphicon glyphicon-check" aria-hidden='true'> Marcar Todos</span></a>
					</td>
				<td style="width:30%">
					<a href="{{ route('admin.menvios.dunmarkall', $denvios[0]->menvio->id ) }}" class="btn btn-info" data-toggle="tooltip" title="Desmarcar todos"><span class="glyphicon glyphicon-unchecked" aria-hidden='true'> Desmarcar Todos</span></a>
					</td>
				<td style="width:30%">
					{!! Form::model($denvios, array('route' => array('admin.menvios.dupdate'), 'method' => 'POST')) !!}
					{!! Form::submit('Grabar cambios de la página', ['class'=>'btn btn-primary']) !!}</td>
				<td style="width:30%">
					<a href="{{ route('admin.menvios.index') }}" class="btn btn-success" data-toggle="tooltip" title="Regresar al índice"><span class="glyphicon glyphicon-menu-right" aria-hidden='true'> Regresar al índice</span></a>
					</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped">
 		<thead>
 			<th>Id</th>
 			<th>Codigo</th>
 			<th>Docente Comunicado</th>
 			<th>Email enviado</th>
 			<th>Email con copia</th>
 			<th>Enviar</th>
 		</thead>
 		<tbody>
 			@foreach($denvios as $envio )
 				<tr>
 					<td>{{ $envio->id }}</td>
 					<td>{{ $envio->user->username }}</td>
 					<td>{{ substr($envio->user->wdocente($envio->user_id),0,40) }}</td>
 					<td>{{ $envio->email_to }}</td>
 					<td>{{ $envio->email_cc }}</td>
 					<td>
 						{{ Form::hidden('xenvios['.$envio->id.']->sw_envio', 0) }}	
						@if($envio->sw_envio == 1)	
							{!! Form::checkbox('xenvios['.$envio->id.']->sw_envio', 1, true , ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
						@else	
							{!! Form::checkbox('xenvios['.$envio->id.']->sw_envio', 0, false, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
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

@section('view','admin/envios/send.blade.php')	

