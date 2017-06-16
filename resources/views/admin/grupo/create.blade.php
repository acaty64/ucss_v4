@extends('template.main')

@section('title','Crear Nuevo Grupo')

@section('content')

	{!! Form::open(['route'=>'admin.grupo.store', 'method'=>'POST']) !!}
		{!! csrf_field() !!}

		<div class="form-group">
			{!! Form::label('cgrupo','Código de Grupo (máximo 3 caracteres)') !!}
			{!! Form::text('cgrupo', old('cgrupo',''), ['class'=>'form-control', 'placeholder'=>'Ingrese el código del grupo','required', 'maxlength'=>"3"]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wgrupo','Nombre de Grupo') !!}
			{!! Form::text('wgrupo', old('wgrupo',''), ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del grupo','required']) !!}
		</div>

		<br>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class'=>'btn btn-lg btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/grupo/create.blade.php')