Vue.component('registro', {
    template: '#registro_template',
    methods: {
        up: function () {
            this.prioridad = this.prioridad-1.1;
            this.ordenar();
        },
        top: function () {
            this.prioridad = 0.9;
            this.ordenar();
        },
        down: function () {
            this.prioridad = this.prioridad+1.1;
            this.ordenar();
        },
        bottom: function () {
            last = this.registros.length;
            if (this.prioridad != last) {
              this.prioridad = last + 0.1;
              this.ordenar();
            };
        },

    },
    computed: {

    },
    props: ['id', 'cdocente', 'wdocente', 'prioridad', 'registros']            
});

var vm = new Vue({
    el: "#app",
    data: {
        registros: [],
        grupo_id: "",
        curso_id: "",
        facultad_id: "",
        sede_id: "",

        options:{
	    	grupo_id: "",
	    	curso_id: "",
	    	facultad_id: "",
	    	sede_id: "",
		},

		errors: [],
        request: [],
    },
        ordenar: function(){
            this.registros.sort(function (a, b){
                return (a.prioridad - b.prioridad)
            });
            num = 0;
            for (xreg in this.registros){
                this.registros[xreg].prioridad = ++num;
            };
            return this.registros;
        },
    ready: function () {
        this.options = {
	        	grupo_id:this.grupo_id, 
	        	curso_id:this.curso_id, 
	        	facultad_id:this.facultad_id, 
	        	sede_id:this.sede_id
        	};
        //console.log(this.options);

        this.$http.post('/api/dcurso/index', this.options)
        	.then(function (response) {
            	this.registros = response.data.data;
        	}, function (response) {
        	    console.log('error');
            	this.errors = response.data.errors;
        });

/*        $.getJSON('/api/dcurso/index/'+this.grupo_id+'/'+this.curso_id+'/'+this.facultad_id+'/'+this.sede_id, [], function (argument) {
            console.log(argument);
            vm.registros = argument.data;
        });
*/
    },    

    computed: {

    },


    methods: {
        signUp: function (logout, event) {
        	event.preventDefault();

            for (xreg in this.registros){
                this.request.push(this.registros[xreg]);
//                this.registros[xreg].prioridad = ++num;
            };
console.log(this.request);

//            this.$http.post('/api/dcurso/update', this.registros)
            this.$http.put('/api/dcurso/update', this.request)
            .then(function (response) {
console.log(response.data.data);
                this.registros = response.data;
                alert('Modificaciones grabadas');
            }, function (response) {
               alert('error');
            });
    	},

	},
});

