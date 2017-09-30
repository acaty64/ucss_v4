<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @include('template.partials.nav_login')        
        @include('template.partials.errors')
        @yield('content')
    </div>
    <div class="container">
        <div class="panel panel-footer">
            @include('template.partials.footer')
        </div>
    </div>
    @yield('footer')
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
