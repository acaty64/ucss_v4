@extends('template.main')

@section('title','Disponibilidad de Cursos: '.substr($docente->wDocente(),0,50) )

@section('content')
<div class="panel panel-default row">
	<div class="container">
		<p>Agregue o elimine los cursos que está dispuesto a dictar en el presente semestre dentro del recuadro Cursos.</p>
		<p>Grabe la información modificada o confirme los cursos presentados.</p>
	</div>
</div>
<div class="row">
	<!-- INICIO Formulario para seleccionar disponibilidad de cursos -->
	{!! Form::open(['route' => 'admin.dcurso.update', 'method'=>'PUT']) !!}
	{!! Field::hidden('docente_id',$docente->user_id) !!}
	<div class="col-xs-12">
		{!! Form::label('cursos','Cursos') !!}
		<!-- select(nombre del campo, lista de opciones, array con opciones seleccionadas,[opciones chosen]) -->
		<span>
			{!! Form::select('cursos[]', $lxgrupos, $ch_cursos, ['multiple class'=>'chosen-select select-curso', 'multiple', 'id'=>'dcursos']) !!}
		</span>
	</div>
</div>
<div class="row">
	<br>
	@if($sw_cambio == '1')
		{!! Form::submit('Grabar o Confirmar cursos', ['class'=>'btn btn-primary', 'id'=>'grabar']) !!}		
	@else
		<p style="color:red">
			La fecha límite de modificación ha expirado. Si necesita modificar su disponibilidad comuníquese con la coordinación académica.
		</p>
	@endif
	{!! Form::close() !!}
	<!-- FIN Formulario para seleccionar disponibilidad de cursos -->
</div>
<hr>
<div class="panel panel-default"> <br>
	<div class="container">
	<div class="row">
		<!-- INICIO Formulario para ver silabo de cursos -->
		<div class="col-xs-12" style="text-align:center">
			VISUALIZACIÓN DE SÍLABOS DE TODOS LOS CURSOS
		</div>
	</div>
	<div class="row">
		<div class="col-xs-9">
			Seleccione el curso para visualizar el sílabo
		</div>
		<div class="col-xs-3">
			Acción
		</div>
	</div>
	<!-- INICIO Formulario para ver silabo de cursos -->
	<div class="row">
		{!! Form::open(['route' => 'admin.PDF.silaboCurso', 'method'=>'PUT']) !!}
		<div class="col-xs-9">
			{!! Form::select('curso_id', $lxgrupos, null, ['class'=>'chosen-select select-silabo', 'include_group_label_in_selected'=>'true']) !!}
		</div>
		<div class="col-xs-3">
			{!! Form::submit('Ver silabo' ,['class'=>'btn btn-primary btn-xs', 'id'=>'ver']) !!}
		</div>
		{!! Form::close() !!}
		<hr>
	</div>
	<!-- FIN Formulario para ver silabo de cursos -->

	</div>
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
	<script>
		$(".select-silabo").chosen({
			placeholder_text_multiple:"Haga click aquí para seleccionar los silabos",
			width: "95%"
		}); 
	</script>
@endsection

@section('view','admin/dcursos/edit.blade.php')	
