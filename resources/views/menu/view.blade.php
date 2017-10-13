@extends('template.main')

@section('title', 'Visualización de Menues' )

@section('view','menu/view.blade.php')

@section('content')

<span id="view_app">
	<img v-show="loading_type" src="/images/loading.gif"></img>
	<ul>
		<li v-for="type in types">
			@{{type.name}} : <input @@click="refresh(type.id)" type="radio" v-model="type_id" value=@{{type.id}} >
		</li>
	</ul>

	<br>
	<nav class="navbar navbar-default" style="background-color: rgb(0,255,0);">
		<div class="container-fluid">
			<img v-show="loading_view" src="/images/loading.gif"></img>
	
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header" v-if="loading_view == false">
				<a class="navbar-brand" href="#">Menu: </a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" v-if="loading_view == false">
				<!-- Left Side Of Navbar -->
				<span id='app_view'>
			    	<ul class="nav navbar-nav" name="leftside">
			    		<template v-for="view_item in view_items">
			    			<view_ul :view_item="view_item"></view_ul>
			    		</template>
			    	</ul>
				</span>
			</div><!-- /.navbar-collapse -->			
		</div><!-- /.container-fluid -->
	</nav>
	<div class='panel panel-default'>
		<div v-if="ruta">
			Ruta asignada: @{{ruta}}
		</div>
		<div v-if="help">		
			Detalle de Ayuda: @{{help}}
		</div>
	</div>

</span>
@verbatim
<template id="view_ul_tpl">
	<template v-if="submenu == false">
		<li><a href="#" @click="view_href( view_item.href , view_item.help)">{{view_item.name}}</a></li>
		<!--li><a href={{view_item.href}}>{{view_item.name}}</a></li-->
	</template>
	<template v-if="submenu">
		<li class='dropdown'>
			<a href='#' @click="view_href( view_item.href , view_item.help)" class='dropdown-toggle' role='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>{{view_item.name}}<span class='caret'></span></a>
			<ul class='dropdown-menu'aria-labelledby='dropdownMenu2'>
				<template v-for="subview_item in view_item.submenu">
					<li><a href='#' @click="view_href(subview_item.href)">{{subview_item.name}}</a></li>
					<!--li><a href={{subview_item.href}}>{{subview_item.name}}</a></li-->
				</template>
			</ul>
		</li>
	</template>
</template>
@endverbatim

<script type="text/javascript">
	Vue.component('view_ul',  {
		template: "#view_ul_tpl",
		props: ['view_item'],
		computed:{
   	   		submenu: function () {
   	   			if(this.view_item.href == 'submenu'){
   	   				return true;
   	   			}
   	   			return false;
   	   		}
	   	},
		methods: {
			view_href: function (text_href, text_help) {
				//alert('Ruta asignada: ' + text);
				this.$parent.mensaje(text_href, text_help);
			},
		}

	});

   	new Vue({
		el: "#view_app",
		data: {
			loading_view: false,
			loading_type: false,
			ruta: false,
			help: false,
			user_id: '?',
			type_id: 1,
			types:[],

			view_items:[],
		},

		ready: function() {
			loading_type: true,			
			this.loadTypes();
			loading_type: false,
			this.refresh(1);
	    },

	    methods:{
	    	loadTypes: function () {
	    		this.$http.get('/api/loadTypes').then(function (response) {
	    			this.types = response.data;
	    		}.bind(this),
		        function (response) {
		        	// error callback
		        });
	    	},
			refresh: function (type_id) {
				this.loading_view = true;
	            this.ruta = false;
	            this.help = false;
		   	    this.$http.get('/api/generar/'+type_id)
		        .then(function (response) {
		            this.view_items = response.data;
		        	this.loading_view = false;
		        }.bind(this),
		        function (response) {
		        	// error callback
		        });				
			},
			mensaje: function (text_href, text_help) {
				this.ruta = text_href;
				this.help = text_help;
			}	    	
	    }
	});
</script>




@endsection
