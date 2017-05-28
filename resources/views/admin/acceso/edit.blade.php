

		
		<div class="form-group">
			{!! Form::label('type','Tipo') !!}
			{!! Form::select('type', $types , null, ['class'=>'form-control', 'placeholder'=>'Seleccione el tipo','required']) !!}
		</div>