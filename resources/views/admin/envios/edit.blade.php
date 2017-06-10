@extends('template.main')
@section('title','Modificar Grupo de Envios: '.$menvio->id)
@section('content')
	{!! Form::open(['route'=>['administrador.menvio.update', $menvio->id], 'method'=>'PUT']) !!}
		{!! Form::hidden('menvio_id',$menvio->id) !!}
		<div>
			{!! Form::label('tipo','Tipo') !!}
			{!! Form::select('tipo',['disp'=>'Disponibilidad','hora'=>'Horarios Asignados','data'=>'Datos Usuarios'], $menvio->tipo, ['class'=>'form-control', 'placeholder'=>'Seleccione el tipo','required']) !!}
		</div>
		<br>
		<div>
			{!! Form::label('flimite','Fecha límite') !!}
			{!! Form::date('flimite', $menvio->flimite ) !!}
		</div>	
		<br>
		<div>
			{!! Form::label('tx_need','Asunto del correo') !!}
			{!! Form::text('tx_need', $menvio->tx_need , ['class'=>'form-control', 'placeholder'=>'Ingrese el asunto (máximo 100 caracteres)','required', 'maxlength'=>100]) !!}
		</div>
		<br>		
		<div class="form-group">
			{!! Form::submit('Grabar', ['class'=>'btn btn-lg btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/envios/edit.blade.php')	