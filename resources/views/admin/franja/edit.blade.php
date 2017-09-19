@extends('template.main')

@section('title','Modificar Franja :'.$franja->dia.'/'.$franja->turno.'/'.$franja->hora)

@section('content')
	{!! Form::model($franja, array('route' => array('administrador.franja.update'), 'method' => 'PUT')) !!}
		{!! Form::hidden('id',$franja->id) !!}
		{!! Form::hidden('facultad_id',$franja->facultad_id) !!}
		{!! Form::hidden('sede_id',$franja->sede_id) !!}
		<div class="form-group">
			{!! Form::label('dia','Dia') !!}
			{!! Form::text('dia', $franja->dia, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('turno','Turno') !!}
			{!! Form::text('turno', $franja->turno, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('hora','Hora') !!}
			{!! Form::text('hora', $franja->hora, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wfranja','Franja') !!}
			{!! Form::text('wfranja', $franja->wfranja, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/user/edit.blade.php')