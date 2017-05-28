Modificación de Datos del Docente:  $datauser->wdocente
view: admin/datausers/edit.blade.php

		
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
