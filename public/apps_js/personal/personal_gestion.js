Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.directive('chosen', {
    bind: function () {
        var vm = this.vm;
        this.el.options = vm.cities;
        this.el.value = vm.city;

        $(this.el).chosen({
                inherit_select_classes: true,
                width: '30%',
                disable_search_threshold: 999})
            .change( function() {
                    vm.city = this.el.value;
                }.bind(this)
            );
    }
});


new Vue ({

    el: '#modulo',





    data: {
        url_base: '',
        loading_ventana_usuario: false,
        criterio_busqueda: '',
        busqueda_inicializada: false,
        usuarios_encontados: [],

        dep_tus: [],
        dep_tis: [],
        dep_generos: [],
        dep_departamentos: [],
        dep_cargos: [],
        dep_zonas: [],
        dep_distritos: [],
        nuevo_usuario: {
            id_tipo_funcionario: '',
        },

    },

    ready: function() {

        //$('#loadingIndicator').modal('show');
    },

    methods:{

        buscar_usuarios: function() {
            $('#loadingIndicator').modal('show');
            this.busqueda_inicializada = true;
            this.$http.get(this.url_base + '/buscar_registros_dt/' + this.criterio_busqueda, function(resultset){
                this.usuarios_encontados =  resultset;
                $('#loadingIndicator').modal('hide');
            });
        },

        agregar_usuario: function() {
            $('#loadingIndicator').modal('show');
            this.$http.get(this.url_base + '/buscar_dependencias_nu', function(resultset){
                this.dep_tus = resultset.tip_func;
                this.dep_tis = resultset.tip_ident;
                this.dep_generos = resultset.generos;


                this.nuevo_usuario.id_tipo_identificacion = 'C';
                this.nuevo_usuario.id_tipo_funcionario = '1';
                this.nuevo_usuario.id_genero = '3';

                this.agregar_usuario_depedencias_por_tipo();
                $('#loadingIndicator').modal('hide');
                $('#nuevoUsuario').modal('show');
            });
        },

        agregar_usuario_depedencias_por_tipo: function() {
            this.loading_ventana_usuario = true;
            this.dep_departamentos = [];
            this.dep_cargos = [];
            this.dep_zonas = [];
            this.dep_distritos = [];
            this.$http.get(this.url_base + '/buscar_dependencias_nu_por_tipo_funcionario/' + this.nuevo_usuario.id_tipo_funcionario, function(resultset){
                this.dep_departamentos = resultset.dptos;
                this.dep_cargos = resultset.cargos;

                if(resultset.dptos.length > 0){ this.nuevo_usuario.id_departamento = resultset.dptos[0].id_departamento; }
                if(resultset.cargos.length > 0){ this.nuevo_usuario.id_cargo = resultset.cargos[0].id_cargo; }

                if(this.nuevo_usuario.id_tipo_funcionario == 1){ this.dep_distritos = resultset.distritos; this.nuevo_usuario.id_distrito = resultset.distritos[0].id_distrito; }
                if(this.nuevo_usuario.id_tipo_funcionario == 2){ this.dep_zonas = resultset.zonas; this.nuevo_usuario.id_zona = resultset.zonas[0].id_zona; }

                this.loading_ventana_usuario = false;
            });
        },





    }

});