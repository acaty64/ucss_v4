<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','default')</title>
	<!--link href="css/estilos_pdf.css" rel="stylesheet" type="text/css" -->
	<link rel="stylesheet" href="{{ asset('css\estilos_pdf.css') }}">
</head>
<body class='body'>
	<div class='titulo'>@yield('title')</div>
	<hr style='color:blue'>
	<div class='contenido'>
		@yield('content')
	</div>
	<footer class='footer'>
		@yield('template.partials.footer_PDF')
	</footer>
</body>
</html>
