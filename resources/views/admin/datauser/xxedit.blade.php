@extends('template.main')

@section('title','Modificación de Datos del Docente: ' . $datauser->user->wdocente($datauser->user_id))

@section('content')
	{!! Form::model($datauser, array('route' => array('admin.datausers.update', $datauser->id), 'method' => 'POST')) !!}
		{{Form::hidden('id',$datauser->id)}}
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

@section('view','admin/datausers/edit.blade.php')	