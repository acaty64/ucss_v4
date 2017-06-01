@extends('template.A4_PDF')

@section('title','DATOS DE DOCENTE REGISTRADO')

@section('content')
<div class='subtitulo'>
	Nombre de Usuario: {{ $user->name }}<br>
	<hr style='color:blue'>
	{{ $acceso->wfacultad }} - {{ $acceso->wsede }}
	<hr style='color:blue'>
	Tipo: {{ $acceso->ctype }}
<div class='subtitulo'>
<hr style='color:blue'>
	CONTENIDO DE DATOS
</div>
<hr style='color:blue'>

<div class='data'>
	Código de Docente: {{ $datauser->cdocente }}<br>
	<hr style='color:blue'>
	Apellido Paterno: {{ $datauser->wdoc2 }}<br>
	<hr style='color:blue'>
	Apellido Materno: {{ $datauser->wdoc3 }}<br>
	<hr style='color:blue'>
	Nombres: {{ $datauser->wdoc1 }}<br>
	<hr style='color:blue'>
	Celular: {{ $datauser->fono1 }}<br>
	<hr style='color:blue'>
	Tfno.Fijo: {{ $datauser->fono2 }}<br>
	<hr style='color:blue'>
	e-mail principal: {{ $datauser->email1 }}<br>
	<hr style='color:blue'>
	e-mail alternativo: {{ $datauser->email2 }}<br>
	<hr style='color:blue'>
</div>
@endsection

@section('view','pdf/usuario.blade.php')	


