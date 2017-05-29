@extends('template.A4_PDF')

@section('title','DATOS DE DOCENTE REGISTRADO')

@section('content')

<div class='subtitulo'>
	CONTENIDO DE DATOS
</div>
<hr style='color:blue'>

<div class='data'>
	Código de Docente: {{ $view_user['username'] }}<br>
	<hr style='color:blue'>
	Apellido Paterno: {{ $view_user['wdoc2'] }}<br>
	<hr style='color:blue'>
	Apellido Materno: {{ $view_user['wdoc3'] }}<br>
	<hr style='color:blue'>
	Nombres: {{ $view_user['wdoc1'] }}<br>
	<hr style='color:blue'>
	Celular: {{ $datauser[0]['fono1'] }}<br>
	<hr style='color:blue'>
	Tfno.Fijo: {{ $datauser[0]['fono2']}}<br>
	<hr style='color:blue'>
	e-mail principal: {{ $datauser[0]['email1']}}<br>
	<hr style='color:blue'>
	e-mail secundario: {{ $datauser[0]['email2']}}<br>
	<hr style='color:blue'>

</div>


@endsection

@section('view','pdf/usuario.blade.php')	


