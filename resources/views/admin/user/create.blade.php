@extends('template.main')

@section('title','Crear Usuario')

@section('content')

	{!! Form::open(['route'=>'admin.user.store', 'method'=>'POST']) !!}
		{!! csrf_field() !!}

		<div class="form-group">
			{!! Form::label('name','Usuario') !!}
			{!! Form::text('name', old('name',''), ['class'=>'form-control', 'placeholder'=>'Nombre de usuario','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email','Correo Electrónico') !!}
			{!! Form::email('email', old('email',''), ['class'=>'form-control', 'placeholder'=>'prueba@ucss.edu.pe','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password','Contraseña') !!}
			{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'**********','required']) !!}
		</div>

		<br>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class'=>'btn btn-lg btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/user/create.blade.php')