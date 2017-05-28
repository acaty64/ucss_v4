@extends('template.main')

@section('title','Modificar Usuario '.$datauser->wdocente($datauser->id))

@section('content')
	{!! Form::model($datauser, array('route' => array('admin.datauser.update'), 'method' => 'PUT')) !!}
		{!! Form::hidden('id',$datauser->id) !!}
		{!! Form::hidden('user_id',$datauser->user_id) !!}
		<div class="form-group">
			{!! Form::label('cdocente','Codigo') !!}
			{!! Form::text('cdocente', $datauser->cdocente, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc1','Nombres') !!}
			{!! Form::text('wdoc1', $datauser->wdoc1, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc2','Apellido Paterno') !!}
			{!! Form::text('wdoc2', $datauser->wdoc2, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Paterno','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('wdoc3','Apellido Materno') !!}
			{!! Form::text('wdoc3', $datauser->wdoc3, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Materno','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('fono1','Teléfono Celular') !!}
			{!! Form::number('fono1', $datauser->fono1, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('fono2','Teléfono Fijo') !!}
			{!! Form::number('fono2', $datauser->fono2, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email1','Correo Electrónico Principal') !!}
			{!! Form::email('email1', $datauser->email1, ['class'=>'form-control', 'placeholder'=>'example@ucss.edu.pe']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email2','Correo Electrónico Alternativo') !!}
			{!! Form::email('email2', $datauser->email2, ['class'=>'form-control', 'placeholder'=>'example@gmail.com']) !!}
		</div>

		<div class="form-group">
			<tr>
			    <td>
					{!! Form::label('whatsapp','Marque la casilla si tiene instalado Whatsapp') !!}
				</td>
				<td>
				{{ Form::hidden('whatsapp', 0) }}
				@if($datauser->whatsapp == 1)			
					{!! Form::checkbox('whatsapp', 1, true, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
				@else
					{!! Form::checkbox('whatsapp', 0, false, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
				@endif
				</td>	
			</tr>
		</div>

		<div class="form-group">
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('js')
<script type="text/javascript">
	function evento($obj){
		//console.log($obj);
		if($obj.checked)
			$obj.value = 1;
		else
			$obj.value = 0;
	}
</script>		
@endsection

@section('view','admin/datauser/edit.blade.php')

