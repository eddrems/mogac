<table id="{{ $id }}" class="table table-hover table-bordered">
    <colgroup>
        @for ($i = 0; $i < count($columns); $i++)
            <col class="con{{ $i }}" />
        @endfor
    </colgroup>
    <thead>
    <tr class="active">
        @foreach($columns as $i => $c)
            <th align="center" valign="middle" class="head{{ $i }}">{{ $c }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            @foreach($d as $dd)
                <td>{{ $dd }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

<script type="text/javascript">
    jQuery(document).ready(function(){
        oTable = $("#{{ $id }}").dataTable({
            "bProcessing": true,
            "sAjaxSource": "{{ $options['sAjaxSource'] }}",
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
            "aoColumns": [ { "sWidth": "auto" },  { "sWidth": "75px" }, { "sWidth": "75px" }, { "sWidth": "75px" }, { "sWidth": "75px" }, { "sWidth": "160px" }],
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 1,2,3,4,5  ] }
            ]
        });
    });
</script>

@if (!$noScript)
    @include('datatable::javascript', array('id' => $id, 'options' => $options, 'callbacks' =>  $callbacks))
@endif

