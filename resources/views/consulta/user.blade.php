@extends('template.main')

@section('title','DATOS DE USUARIO REGISTRADO')

@section('content')
<table class="table table-striped">
	<thead>
		<tr>
			Nombre de Usuario: {{ $user->name }} <br>
			{{ $acceso->wfacultad }} - {{ $acceso->wsede }}<br>
			Tipo: {{ $acceso->ctype }}<br>
		</tr>
	</thead>
	<tbody>
		<tr><td>Código de Docente: {{ $datauser->cdocente }}</td></tr>
		<tr><td>Apellido Paterno: {{ $datauser->wdoc2 }}</td></tr>
		<tr><td>Apellido Materno: {{ $datauser->wdoc3 }}</td></tr>
		<tr><td>Nombres: {{ $datauser->wdoc1 }}</td></tr>
		<tr><td>Celular: {{ $datauser->fono1 }}</td></tr>
		<tr><td>Tfno.Fijo: {{ $datauser->fono2 }}</td></tr>
		<tr><td>e-mail principal: {{ $datauser->email1 }}</td></tr>
		<tr><td>e-mail alternativo: {{ $datauser->email2 }}</td></tr>
		<tr><td>whatsapp: {{ $datauser->whatsapp }}</td></tr>
	</tbody>
</table>
@endsection

@section('view','consulta/user.blade.php')	


