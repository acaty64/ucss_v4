@extends('template.main')
@section('title','Descripción de Opciones')
@section('content')
	<img v-show="loadHelp" src="/images/loadHelp.gif"></img>
	<div id="help_app" class="panel-body">
		<div class="conteiner" style="margin-top: 0px;">
			<ul class="nav nav-tabs">
				<li v-for="help in helps">
					<a @click="helpView(help.id)" data-toggle='tab'>@{{ help.name }}</a>
				</li>
			</ul>
			<div class="tab-content">
					<h4>@{{ helpPanel.name }} </h4>
					@{{ helpPanel.help }} 
			</div>
		</div>
	</div>

@endsection

@section('view','help.blade.php')

@section('js')

<script type="text/javascript">
	function findById(helps, id) {
	   	for (var i in helps) {
	      	if (helps[i].id == id) {
	         	return helps[i];
	      	}
	   	}
	   	return null;
	}

	new Vue({
		el: "#help_app",
		data: {
			helps:[],
			helpPanel: "",
			loadHelp: false,
		},

	    ready: function() {
	    	this.loadHelp = true;
	   	    this.$http.get('/api/generarHelp/{{Session::get("type_id")}}')
	        .then(function (response) {
	            this.helps = response.data;
	            this.helpView(1);
	        });
	        this.loadHelp = false;
	    },

		methods: {
            helpView: function (id) {
                this.helpPanel = findById(this.helps, id);
            }
        },
	});
</script>
@endsection