@extends('template.main')

@section('title','Disponibilidad Horaria del Docente: ' . $wdocente->wdocente($wdocente->id) )

@section('content')

	<div class="form-group">
		@if( $sw_cambio == '1' )
			{!! Form::submit('Grabar modificaciones', ['class'=>'btn btn-primary']) !!}
		@else
			<p style="color:red">
				La fecha límite de modificación ha expirado. Si necesita modificar su disponibilidad comuníquese con la coordinación académica.
			</p>
		@endif
		{!! Form::close() !!}
	</div>	

@endsection

@section('view','admin/dhora/edit.blade.php')