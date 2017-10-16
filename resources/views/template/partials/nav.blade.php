
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a href="http://www.ucss.edu.pe"  target="_blank"><img class="navbar-brand" src="{{asset('images/logo-ucss.png')}}" ></img></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<!-- Left Side Of Navbar -->
			<span id='app'>
				<img v-show="loading" src="/images/loading.gif"></img>
		    	<ul class="nav navbar-nav" name="leftside">
		    		<template v-for="item in items">
		    			<row_ul :item="item"></row_ul>
		    		</template>
		    	</ul>
			</span>
		
			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li>
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

@verbatim
<template id="row_ul_tpl">
	<template v-if="submenu == false">
		<li><a href={{item.href}}>{{item.name}}</a></li>
	</template>
	<template v-if="submenu">
		<li class='dropdown'>
			<a href='#' class='dropdown-toggle' role='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>{{item.name}}<span class='caret'></span></a>
			<ul class='dropdown-menu'aria-labelledby='dropdownMenu2'>
				<template v-for="subitem in item.submenu">
					<li><a href={{subitem.href}}>{{subitem.name}}</a></li>
				</template>
			</ul>
		</li>
	</template>
</template>
@endverbatim

<script type="text/javascript">
	Vue.component('row_ul',  {
	   template: "#row_ul_tpl",
	   props: ['item'],
	   computed:{
   	   		submenu: function () {
   	   			if(this.item.href == 'submenu'){
   	   				return true;
   	   			}
   	   			return false;
   	   		}
	   },
	});

	new Vue({
		el: "#app",
		data: {
			loading: false,
			items: [],
		},
	    ready: function() {
	    	this.loading = true;
	   	    this.$http.get('/api/generar/{{Session::get("type_id")}}/{{ Auth::user()->id }}')
	        .then(function (response) {
	            this.items = response.data;
	        	this.loading = false;
	        });
	    },
	});
	
</script>