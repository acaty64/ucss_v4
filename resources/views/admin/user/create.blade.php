@extends('template.main')

@section('title','Crear Usuario')

@section('content')

	{!! Form::open(['route'=>'admin.users.store', 'method'=>'POST']) !!}
		{!! csrf_field() !!}
		<div class="form-group">
			{!! Form::label('username','Código') !!}
			{!! Form::text('username', old('username',''), ['class'=>'form-control', 'placeholder'=>'Código Docente','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password','Contraseña') !!}
			{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'**********','required']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('wdoc1','Nombres (wdoc1)') !!}
			{!! Form::text('wdoc1', null, ['class'=>'form-control', 'placeholder'=>'Ingrese sus Nombres','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc2','Apellido Paterno (wdoc2)') !!}
			{!! Form::text('wdoc2', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Paterno','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc3','Apellido Materno (wdoc3)') !!}
			{!! Form::text('wdoc3', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Materno','required']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('type','Tipo') !!}
			{!! Form::select('type',['01'=>'Administrativo','02'=>'Docente','03'=>'Responsable','09'=>'Master'], null, ['class'=>'form-control', 'placeholder'=>'Seleccione el tipo','required']) !!}
		</div>
		<br>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class'=>'btn btn-lg btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/users/create.blade.php')