@extends('template.main')

@section('title','Modificar Accesos de Usuario '.$acceso->wdocente)

@section('content')
	{!! Form::model($acceso, array('route' => array('admin.acceso.update'), 'method' => 'PUT')) !!}
	<table>
		<thead>
			<tr>
				<th class="col-xs-2"></th>
			</tr>
		</thead>
		<tbody>
			<div class="form-group">
				{!! Form::hidden('id',$acceso->id) !!}
				{!! Form::label('facultad_id','Facultad') !!}
	            {!! Form::select('facultad_id', $facultades, $acceso->facultad_id, ['class'=>'form-control',  'placeholder'=>'Seleccione la facultad','required']) !!}
	            <br>
				{!! Form::label('sede_id','Sede') !!}
	            {!! Form::select('sede_id', $sedes, $acceso->sede_id, ['class'=>'form-control',  'placeholder'=>'Seleccione la sede','required']) !!}
	            <br>
				{!! Form::label('type_id','Tipo') !!}
				{!! Form::select('type_id', $types , $acceso->type_id, ['class'=>'form-control', 'placeholder'=>'Seleccione el tipo','required']) !!}	            
	        </div>
		</tbody>
	</table>

	<div class="form-group">
		{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection

@section('view','admin/accesos/edit.blade.php')



		