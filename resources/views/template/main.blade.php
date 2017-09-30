<!DOCTYPE html>
<!-- views/template/main.blade.php -->
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- meta http-equiv="X-UA-Compatible" content="IE=edge" -->
	<title>UCSS</title>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins\chosen\chosen.css') }}">
	<link rel="stylesheet" href="{{ asset('css\main.css') }}">
	<script src={{url("js/vue.js")}} ></script>
	<script src={{url("js/vue-resource.min.js")}} ></script>
</head>
<body class='admin-body'>
	<div class="container">
		@include('template.partials.nav')
	</div>
	<div class="container ">
		<section class='section-admin'>
			<div class='panel panel-default'>
				<div class='panel panel-heading' style="margin-bottom: 0">
					<h3 class='panel-title title-left'>
						@yield('title')
					</h3>
				</div>	
				<div class='panel-body'>
				    @include('flash::message')
					@include('template.partials.errors')
					@yield('content')
				</div>
			</div>
		</section>
	</div>
	<div class="container">
		<div class="panel panel-footer">
			@include('template.partials.footer')
		</div>
		<div class="panel-footer">
			enviroment: {{env('APP_ENV')}}</br>
			@yield('view','Archivo view')
		</div>
	</div>
	<script src="{{ asset('plugins\jquery\js\jquery-3.1.0.js') }}"></script>
	<script src="{{ asset('plugins\bootstrap\js\bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugins\chosen\chosen.jquery.js') }}"></script>
	@yield('js')
</body>
</html>