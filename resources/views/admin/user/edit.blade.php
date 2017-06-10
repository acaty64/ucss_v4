@extends('template.main')

@section('title','Modificar Usuario '.$user->datauser->wdocente())

@section('content')
	{!! Form::model($user, array('route' => array('admin.user.update'), 'method' => 'PUT')) !!}
		{!! Form::hidden('id',$user->id) !!}
		<div class="form-group">
			{!! Form::label('name','Nombre de Usuario') !!}
			{!! Form::text('name', $user->name, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email','Correo Electrónico') !!}
			{!! Form::email('email', $user->email, ['class'=>'form-control', 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/user/edit.blade.php')