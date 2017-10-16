
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a href="http://www.ucss.edu.pe"  target="_blank"><img class="navbar-brand" src="{{asset('images/logo-ucss.png')}}" ></img></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-left">
				<li>
					<a href="#" title="">
						Bienvenidos al Sistema de Información Docente (en prueba)
					</a>
				</li>
			</ul>
			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						        {{ Auth::user()->name_login }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="{{ url('/logout') }}" onclick="event.preventDefault();         document.getElementById('logout-form').submit();">Logout</a>
								<form id='logout-form' action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->			
	</div><!-- /.container-fluid -->
</nav>
