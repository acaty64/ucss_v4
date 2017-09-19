@extends('template.main')

@section('title','Crear Franja')

@section('content')

	{!! Form::open(['route'=>'administrador.franja.store', 'method'=>'POST']) !!}
		{!! csrf_field() !!}

		<div class="form-group">
			{!! Form::label('dia','Dia') !!}
			{!! Form::text('dia', old('dia',''), ['class'=>'form-control', 'placeholder'=>'Dia [1-6]','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('turno','Turno') !!}
			{!! Form::text('turno', old('turno',''), ['class'=>'form-control', 'placeholder'=>'Turno [1-3]','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('hora','Hora') !!}
			{!! Form::text('hora', old('hora',''), ['class'=>'form-control', 'placeholder'=>'Hora [1-4]','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wfranja','Franja') !!}
			{!! Form::text('wfranja', old('wfranja',''), ['class'=>'form-control', 'placeholder'=>'Franja [hh:mm-hh:mm]','required']) !!}
		</div>

		<br>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class'=>'btn btn-lg btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/franja/create.blade.php')