@extends('template.main')

@section('title','Franjas de: ' . $cfacultad .' - '. $wsede )

@section('content')

	<table class="horario">
		<thead>
			<tr>
				<th><div class = 'horario-header'>Turno/Hora</div></th>
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
					<td class = 'horario-dia horario-hora'>
						<span class="badge badge-danger">{{$gfranja['turno'].' /  '.$gfranja['hora']}}</span>
					</td>
					@for ($i=1; $i < 7 ; $i++)
						<td class = 'horario-dia'>
							<div class = 'horario-hora'>
								@if(isset($wfranjas['D'.$i.'_H'.$gfranja['turno'].$gfranja['hora']]))
									<span class="btn btn-info pull-center">{{$wfranjas['D'.$i.'_H'.$gfranja['turno'].$gfranja['hora']]}}</span>
								@else
									<span class="btn btn-secondary pull-center">sin franja</span>
								@endif
							</div>
						</td>
					@endfor
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection

@section('view','admin/franja/show.blade.php')