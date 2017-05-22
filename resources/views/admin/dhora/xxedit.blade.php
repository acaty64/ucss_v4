@extends('template.main')

@section('title','Disponibilidad Horaria del Docente: ' . $wdocente->wdocente($wdocente->id) )

@section('content')
	{!! Form::model($dhoras, array('route' => ['admin.dhora.update', $dhoras->id], 'method' => 'PUT')) !!}
	{{Form::hidden('user_id',$wdocente->id)}}
	{{Form::hidden('dhoras_id',$dhoras->id)}}
	<table class="horario">
		<thead>
			<tr>
				<th><div class = 'horario-header'>LUNES</div></th>
				<th><div class = 'horario-header'>MARTES</div></th>
				<th><div class = 'horario-header'>MIÉRCOLES</div></th>
				<th><div class = 'horario-header'>JUEVES</div></th>
				<th><div class = 'horario-header'>VIERNES</div></th>
				<th><div class = 'horario-header'>SÁBADO</div></th>
			</tr>
		</thead>
		<tbody >
			@foreach ($gfranjas as $gfranja) 
				<tr class = 'horario-franja'>
					@for ($i=1; $i < 7 ; $i++)
						<td class = 'horario-dia'>
							<div class = 'horario-hora'>
								<?php  $campo = 'D'.$i.'_H'.$gfranja->turno.$gfranja->hora ?>
								@if($dhoras->$campo == '1')
									<input type='checkbox' 	
										name = {{$campo}}
										checked>
										{{$gfranja->wfranja}}
								@else
									<input type='checkbox' 	
										name = {{$campo}}
										unchecked>
										{{$gfranja->wfranja}}
								@endif
							</div>
						</td>
					@endfor
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="form-group">
		@if( $sw_cambio == '1' )
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		@else
			<p style="color:red">
				La fecha límite de modificación ha expirado. Si necesita modificar su disponibilidad comuníquese con la coordinación académica.
			</p>
		@endif
		{!! Form::close() !!}
	</div>	

@endsection

@section('view','admin/dhora/edit.blade.php')