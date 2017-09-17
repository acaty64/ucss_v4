@extends('template.main')

@section('title','Grupo de Cursos: '.$grupo->wgrupo )

@section('content')
<div class="panel panel-default row">
	<div class="container">
		<p>Agregue o elimine los cursos del grupo.</p>
	</div>
</div>
<div class="row">
	<!-- INICIO Formulario para seleccionar los cursos del grupo -->
	{!! Form::open(['route' => 'admin.cursogrupo.update', 'method'=>'PUT']) !!}
	<div class="col-xs-12">
		{!! Form::label('cursos','Cursos') !!}
		<!-- select(nombre del campo, lista de opciones, array con opciones seleccionadas,[opciones chosen]) -->
		<span>
			{!! Form::select('cursos[]', $lcursos, $ch_cursos, ['multiple class'=>'chosen-select select-curso', 'multiple', 'id'=>'cursos']) !!}
		</span>
	</div>
</div>
<div class="row">
	<br>
		{!! Form::submit('Grabar o Confirmar cursos', ['class'=>'btn btn-primary', 'id'=>'grabar']) !!}		
	{!! Form::close() !!}
	<!-- FIN Formulario para seleccionar disponibilidad de cursos -->
</div>

@endsection
<!--*******************************-->
@section('js')
	<script>
		$(".select-curso").chosen({
			placeholder_text_multiple:"Haga click aquí para seleccionar los cursos",
			width: "95%"
		}); 
	</script>

@endsection

@section('view','admin/cursogrupo/edit.blade.php')	
