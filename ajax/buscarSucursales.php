<div class="table-responsive">
                                            <table id="example" class="display table dt-responsive" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre</th>
                                                        <th>Direcci&oacute;n</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
<script>
    $('#example').DataTable( {
        "ajax": '../ajax/buscarSucursales1.php',
        "lengthMenu": [
            [10, 15, 20, -1],
            ['10', '15', '20', 'Todo']
        ],
        "language": {
            "sProcessing":    "<img src='../img/company/load.svg' style='width: 50px;'>",
            "sLengthMenu":    "Mostrar _MENU_",
            "sZeroRecords":   "<div class='alert alert-secondary alert-outline alert-dismissible fade show' role='alert' style='text-align: center;'><img src='../assets/images/error/internal-server.svg' style='width: 300px;'><br><strong>Oopss!</strong> No se han encontrado registros en nuestra base de datos. <a data-toggle='modal' data-target='#nuevoSucursal' style='cursor: pointer;' class='alert-link'>Registrar Sucursal</a></div>",
            "sEmptyTable":    "<div class='alert alert-danger alert-outline alert-dismissible fade show' role='alert' style='text-align: center;'><img src='../assets/images/error/internal-server.svg' style='width: 300px;'><br><strong>Oopss!</strong> Ning&uacute;n dato disponible.</div>",
            "sInfo":          "Mostrando _START_ al _END_ de _TOTAL_ ",
            "sInfoEmpty":     "Mostrando 0 al 0 de 0",
            "sInfoFiltered":  "(filtrado de _MAX_)",
            "sInfoPostFix":   "",
            "sSearch":        "<a onclick='load(1);' style='cursor: pointer; height:30px; font-size: 12px;' class='btn btn-info'><i class='la la-refresh' style='color: #fff; margin-top: -5px;'></i></a> <a data-toggle='modal' data-target='#nuevoSucursal' style='cursor: pointer; height:30px; font-size: 12px;' class='btn btn-primary'><i class='la la-plus' style='color: #fff; margin-top: -5px;'></i></a>",
            "searchPlaceholder": "Buscar...",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "<img src='../img/company/load.svg' style='width: 50px;'>",
            "oPaginate": {
                "sFirst":    "<i class='mdi mdi-skip-backward'></i>",
                "sLast":    "<i class='mdi mdi-skip-forward'></i>",
                "sNext":    "<i class='mdi mdi-skip-next'></i>",
                "sPrevious": "<i class='mdi mdi-skip-previous'></i>"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        },
    } );
</script>