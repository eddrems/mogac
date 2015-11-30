Vue.directive('dt', {
    bind: function () {

        $(this.el)
            .dataTable({
                "bProcessing": true,
                "sAjaxSource": "http://localhost:8085/appMOGAC/public/catalogos/procesos_ac/buscar_registros_dt",
                "bServerSide": true,
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sProcessing":   "Procesando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "No se encontraron resultados",
                    "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sPrevious": "Anterior",
                        "sNext":     "Siguiente",
                        "sLast":     "Último"
                    }
                },
                "bAutoWidth": false,
                "aoColumns": [{ "sWidth": "270px" }, { "sWidth": "auto" }, { "sWidth": "80px" }, { "sWidth": "75px" }, { "sWidth": "75px" }, { "sWidth": "130px" }],
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 2,3,4,5 ] }
                ]
            });
    }
});

new Vue ({

    el: '#modulo',





    data: {

        grupo_registro_calificaciones_id: 0,
        materia_asignada_id: 0,
        main_route: '',

        modelo: [],

        loader_text: 'Cargando Calificaciones...',



    },

    ready: function() {

    },

    methods:{



        visualizar_requerimientos: function(){
            alert('oim');
        },







    }

});