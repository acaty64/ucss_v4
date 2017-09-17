Vue.component('registro', {
    template: '#registro_template',
    methods: {
        up: function () {
            this.prioridad = this.prioridad-1.1;
            this.$parent.ordenar();
            this.$parent.saving = true;
        },
        top: function () {
            this.prioridad = 0.9;
            this.$parent.ordenar();
            this.$parent.saving = true;
        },
        down: function () {
            last = this.$parent.last_registro;
            if (this.prioridad != last) {
                this.prioridad = this.prioridad+1.1;
                this.$parent.ordenar();
                this.$parent.saving = true;
            };
        },
        bottom: function () {
            last = this.$parent.last_registro;
            if (this.prioridad != last) {
                this.prioridad = last + 0.1;
                this.$parent.ordenar();
                this.$parent.saving = true;
            };
        },
    },
    computed: {

    },
    props: ['cdocente', 
            'curso_id', 
            'facultad_id', 
            'id', 
            'prioridad', 
            'sede_id',
            'user_id', 
            'wdocente',
            'sw_cambio', 
            'grupo_id'],          
});

var vm = new Vue({
    el: "#app",
    data: {
        registros: [],

        curso_id: "",
        facultad_id: "",
        sede_id: "",
        grupo_id: "",

        options:{
            grupo_id: "",
            curso_id: "",
            facultad_id: "",
            sede_id: "",
        },

        errors: [],
        request: [],

        saving: false,
    },
   
    ready: function () {
        this.show();
    },

    computed: {
        last_registro: function () {
          return this.registros.length;
        },
    },

    methods: {
        show: function(){
            this.options = {
                    grupo_id:this.grupo_id, 
                    curso_id:this.curso_id, 
                    facultad_id:this.facultad_id, 
                    sede_id:this.sede_id
                };
            this.$http.post('/api/dcurso/index', this.options)
                .then(function (response) {
                    this.registros = response.data.data;
                    this.saving = false;
                    this.ordenar();
                }, function (response) {
                    console.log('error');
                    this.errors = response.data.errors;
            });    
        },

        ordenar: function(){
            this.registros.sort(function (a, b){
                return (a.prioridad - b.prioridad)
            });
            // renumerar
            num = 0;
            for (xreg in this.registros){
                this.registros[xreg].prioridad = ++num;
                this.registros[xreg].grupo_id = this.grupo_id;
            };
        },

        signUp: function (logout, event) {
            event.preventDefault();
            this.$http.post('/api/dcurso/update', {registros: this.registros})
            .then(function (response) {
                this.saving = false;
                alert('Modificaciones grabadas');
                this.show;
            }, function (response) {
               alert('error');
            });
        },
    }
});