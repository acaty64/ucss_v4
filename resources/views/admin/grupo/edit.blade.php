@extends('template.main')

@section('title','Modificar Grupo '.$grupo->wgrupo)

@section('content')
	{!! Form::model($grupo, array('route' => array('admin.grupo.update'), 'method' => 'PUT')) !!}
		{!! Form::hidden('id',$grupo->id) !!}
		<div class="form-group">
			{!! Form::label('cgrupo','Código de Grupo (máximo 3 caracteres)') !!}
			{!! Form::text('cgrupo', $grupo->cgrupo, ['class'=>'form-control', 'required', 'maxlength'=>"3"]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wgrupo','Nombre de Grupo') !!}
			{!! Form::text('wgrupo', $grupo->wgrupo, ['class'=>'form-control', 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/grupo/edit.blade.php')