<nav class="navbar navbar-default navbar-static-top">
<div class="container">
<div class="navbar-header">
<!-- Collapsed Hamburger -->
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<!-- Branding Image -->
<a class="navbar-brand" href="{{ url("/") }}">
{{ config("app.name", "Laravel") }}
</a>
</div>
<div class="collapse navbar-collapse" id="app-navbar-collapse">
<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav" name="leftside">
@if('can:is_master')
<li><a href="{{ route('home')}}">Inicio</a></li>
<li><a href="{{ route('master.menu.index')}}">Menus</a></li>
<li><a href="{{ route('master.menu.generar')}}">Generar Menus</a></li>
<li><a href="{{ route('master.type.index')}}">Tipos de Usuarios</a></li>
<li><a href="{{ route('master.menutype.index')}}">Asignacion de Menus</a></li>
@endif
@if('can:is_consulta')
<li><a href="{{ route('home')}}">Inicio</a></li>
<li><a href="{{ route('consulta.user.index')}}">Lista de Usuarios</a></li>
@endif
@if('can:is_docente')
<li><a href="{{ route('home')}}">Inicio</a></li>
<li><a href="{{ route('docente.datauser.edit,$datauser->id')}}">Datos Personales</a></li>
<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Disponibilidad
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu2'>
</ul></li>
<li><a href="{{ route('docente.dhoras.edit')}}">Días y Horas</a></li>
<li><a href="{{ route('docente.dcursos.edit')}}">Cursos</a></li>
<li><a href="{{ route('docente.horario.show')}}">Carga Asignada</a></li>
@endif
@if('can:is_responsable')
<li><a href="{{ route('home')}}">Inicio</a></li>
<li><a href="{{ route('responsable.datauser.edit,$datauser->id')}}">Datos Personales</a></li>
<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Disponibilidad
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu2'>
</ul></li>
<li><a href="{{ route('responsable.dhoras.edit')}}">Días y Horas</a></li>
<li><a href="{{ route('responsable.dcursos.edit')}}">Cursos</a></li>
<li><a href="{{ route('responsable.horario.show')}}">Carga Asignada</a></li>
<li><a href="{{ route('responsable.grupocursos.index')}}">Prioridad Docentes</a></li>
@endif
@if('can:is_administrador')
<li><a href="{{ route('home')}}">Inicio</a></li>
<li><a href="{{ route('administrador.user.index')}}">Usuarios</a></li>
<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Grupos de Cursos
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu2'>
</ul></li>
<li><a href="{{ route('administrador.grupos.index')}}">Grupos</a></li>
<li><a href="{{ route('administrador.usergrupos.index')}}">Responsables</a></li>
<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Verificaciones
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu3'>
</ul></li>
<li><a href="{{ route('administrador.dhoras.lista')}}">Actualización de Disponibilidad Horaria</a></li>
<li><a href="{{ route('administrador.dcursos.lista')}}">Actualización de Disponibilidad de Cursos</a></li>
<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' role='button' id='dropdownMenu4' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Acciones
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu4'>
</ul></li>
<li><a href="{{ route('administrador.menvios.index')}}">Envío de Correos Electrónicos</a></li>
@endif
</ul>
<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
<!-- Authentication Links -->
@if (Auth::guest())
<li><a href="{{ url("/login") }}">Login</a></li>
<li><a href="{{ url("/register") }}">Register</a></li>
@else
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
{{ Auth::user()->name_login }} <span class="caret"></span>
</a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ url("/logout") }}" onclick="event.preventDefault();         document.getElementById("logout-form").submit();">Logout</a>
<form id="logout-form" action="{{ url("/logout") }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
</li>
</ul>
</li>
@endif
</ul>
</div>
</div>
</nav>
