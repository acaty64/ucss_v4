@extends('template.main')

@section('title','Modificar Usuario '.$user->wdocente($user->id) . ' / código: ' . $user->username)

@section('content')
	{!! Form::model($user, array('route' => array('admin.users.update', $user->id), 'method' => 'PUT')) !!}
		{{Form::hidden('username',$user->username)}}
		<div class="form-group">
			{!! Form::label('wdoc1','Nombres') !!}
			{!! Form::text('wdoc1', $user->wdoc1, ['class'=>'form-control', 'placeholder'=>'Ingrese sus Nombres','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc2','Apellido Paterno') !!}
			{!! Form::text('wdoc2', $user->wdoc2, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Paterno','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc3','Apellido Materno') !!}
			{!! Form::text('wdoc3', $user->wdoc3, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Materno','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('type','Tipo') !!}
			{!! Form::select('type', ['01'=>'Administrativo','02'=>'Docente','03'=>'Responsable','09'=>'Master'], $user->type, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/users/edit.blade.php')