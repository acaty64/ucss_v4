@extends('template.main')

@section('title','Modificar Usuario '.$datauser->wdocente($datauser->id))

@section('content')
	{!! Form::model($datauser, ['route' => strtolower(Session::get('ctype')) .'.datauser.update', 'method' => 'PUT']) !!}
		{!! Form::hidden('id',$datauser->id) !!}
		{!! Form::hidden('user_id',$datauser->user_id) !!}
	<table>
		<thead>
			<tr>
				<th class="col-xs-2"></th>
				<th class="col-xs-2"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="form-group">
						@can('is_admin', $acceso_auth)
							{!! Form::label('cdocente','Codigo') !!}
							{!! Form::text('cdocente', $datauser->cdocente, ['class'=>'form-control', 'required']) !!}
						@else
							{!! Form::label('cdocente','Codigo (No modificable)') !!}
							{!! Form::label('cdocente', $datauser->cdocente, ['class'=>'form-control']) !!}
						@endcan
					</div>
				</td>
				<td>
					<div class="form-group">
						{!! Form::label('wdoc1','Nombres') !!}
						{!! Form::text('wdoc1', $datauser->wdoc1, ['class'=>'form-control', 'required']) !!}
					</div>			
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						{!! Form::label('wdoc2','Apellido Paterno') !!}
						{!! Form::text('wdoc2', $datauser->wdoc2, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Paterno','required']) !!}
					</div>				
				</td>
				<td>
					<div class="form-group">
						{!! Form::label('wdoc3','Apellido Materno') !!}
						{!! Form::text('wdoc3', $datauser->wdoc3, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido Materno','required']) !!}
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						{!! Form::label('fono1','Teléfono Celular') !!}
						{!! Form::number('fono1', $datauser->fono1, ['class'=>'form-control']) !!}
					</div>
				</td>
				<td>
					<div class="form-group">
						{!! Form::label('fono2','Teléfono Fijo') !!}
						{!! Form::number('fono2', $datauser->fono2, ['class'=>'form-control']) !!}
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						@can('is_admin', $acceso_auth)
							{!! Form::label('email1','Correo Electrónico Principal') !!}
							{!! Form::email('email1', $datauser->email1, ['class'=>'form-control', 'placeholder'=>'example@ucss.edu.pe']) !!}
						@else
							{!! Form::label('email1','Correo Electrónico Principal (No modificable)') !!}
							{!! Form::label('email1', $datauser->email1, ['class'=>'form-control']) !!}
						@endcan
					</div>
				</td>
				<td>
					<div class="form-group">
						{!! Form::label('email2','Correo Electrónico Alternativo') !!}
						{!! Form::email('email2', $datauser->email2, ['class'=>'form-control', 'placeholder'=>'example@gmail.com']) !!}
					</div>
				</td>
			</tr>
			<tr>
				<td style='text-align: right'>
					{!! Form::label('whatsapp','Marque la casilla si tiene instalado Whatsapp') !!}					
				</td>
				<td>
					<div style="margin-left: 10px">
						{{ Form::hidden('whatsapp', 0) }}
						@if($datauser->whatsapp == 1)			
							{!! Form::checkbox('whatsapp', 1, true, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
						@else
							{!! Form::checkbox('whatsapp', 0, false, ['class'=>'checkbox', 'onclick' => 'javascript:evento(this);'] ) !!}
						@endif
					</div> 
				</td>
			</tr>
		</tbody>
	</table>

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

