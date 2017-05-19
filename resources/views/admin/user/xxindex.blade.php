@extends('template.main')

@section('title','Lista de Usuarios')

@section('content')
		@if('can:is_admin')
			<a href="{{ route('admin.user.create') }}" class="btn btn-info" id='NuevoUsuario'>Registrar Nuevo Usuario</a>
		@endif
		<!-- INICIO DEL BUSCADOR  -->
		{!! Form::open(['route' => 'admin.user.index', 'method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
			<div class="form-group">
				{!! Form::select('type', ['01'=>'Administrativo','02'=>'Docente','03'=>'Responsable','09'=>'Master'],null,['placeholder'=>'Tipo']) !!}
			</div>
			<div class="input-group">
				{!! Form::text('wdocente', null, ['class'=>'form-control', 'placeholder'=>'Buscar docente...', 'aria-describedby'=>'search']) !!}
				<span class="input-group-addon" id='search'><span class="glyphicon glyphicon-search" "aria-hidden"="true"></span></span>
			</div>
		{!! Form::close() !!}
	</hr>
	<!-- FIN DEL BUSCADOR -->
	<table class="table table-striped">
 		<thead>
 			<th>id</th>
 			<th>Código</th>
 			<th>Docente</th>
 			<th>Tipo</th>
 			<th>Acción</th>
 		</thead>
 		<tbody> 			
 			@foreach($users as $user)
 				<tr>
	 				<td>{{ $user->id }}</td>
	 				<td>{{ $user->cdocente }}</td>
	 				<!--  ACTIVAR CUANDO SE MODIFIQUE DATA docentes <td>{{ $user->wDocente($user->id) }}</td>-->
	 				<td>{{ substr($user->wdocente($user->id),0,50) }}</td>
	 				<td>
	 					@if($user->type == '01')
	 						<span class="label label-warning">Administrativo</span>
	 					@elseif ($user->type == '02') 
	 						<span class="label label-success">Docente</span>
	 					@elseif ($user->type =='03') 
	 						<span class="label label-danger">Responsable</span>
	 					@elseif($user->type == '09')
	 						<span class="label label-info">Master</span>
	 					@endif
	 				</td>	
	 				<td>
	 					@if(\Auth::user()->type == '09')
		 					<a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar usuario" name = "{{'Mody'.$user->username}}"><span class="glyphicon glyphicon-wrench" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.user.editpass', $user->id) }}" class="btn btn-danger" data-toggle="tooltip" title="Modificar password" name = "{{'EditPass'.$user->username}}"><span class="glyphicon glyphicon-lock" aria-hidden='true'></span></a>
		 					
		 					<a href="{{ route('admin.user.destroy', $user->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar usuario" name = "{{'Dele'.$user->username}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>

		 					<a href="{{ route('admin.datauser.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Modificar datos usuario" name = "{{'EditData'.$user->username}}"><span class="glyphicon glyphicon-earphone" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.dhora.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad Horaria" name = "{{'Dhora'.$user->username}}"><span class="glyphicon glyphicon-calendar" aria-hidden='true'></span></a>

		 					<a href="{{ route('admin.dcurso.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Disponibilidad de Cursos" name = "{{'Dcurso'.$user->username}}"><span class="glyphicon glyphicon-list-alt" aria-hidden='true'></span></a>
		 				@endif	 					


	 					
	 				</td>
	 			</tr>
 			@endforeach
 			
 		</tbody>
	</table>
	{!! $users->render() !!}

@endsection

@section('view','admin/users/index.blade.php')

@section('borrador')
<?php 
/**
<!-- TODO: ruta PDF -->
<!--a href="{{ route('PDF.usuario', $user->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Ver PDF" name="Ver PDF"><span class="glyphicon glyphicon-eye-open" aria-hidden='true'></span></a-->



	 					<!--MODELO INVOICE Route::get('pdf', 'PdfController@invoice'); -->
	 					<!-- route('pdf', 'PDFController@invoice') -->
	 					<!-- a href="{{ route('pdf', 'PDFController@invoice') }}" class="btn btn-success">Invoice</a-->

*/
 ?>
@endsection