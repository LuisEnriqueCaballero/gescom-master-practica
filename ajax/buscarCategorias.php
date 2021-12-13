<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
?>
<div id="toolbarCategorias">
    <button class="btn btn-primary" data-toggle='modal' data-target='#nuevoCategoria' style="cursor: url(../img/company/cursorH1.png), pointer;"><i class='la la-plus' style='color: #fff; margin-top: -5px;'></i></button>
  <button class="btn btn-danger" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="clientesPDF();">PDF</button>
  <button class="btn btn-success" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="clientesExcel();">Excel</button>
</div>
<table
data-toggle="table"
data-toolbar="#toolbarCategorias"
data-mobile-responsive="true"
data-search="true"
data-show-refresh="true"
data-show-columns="true"
data-click-to-select="true"
data-sort-name="0"
data-page-list="[5, 10, 20]"
data-page-size="10"
data-show-pagination-switch="true"
data-pagination="true"
id="tableCategorias">

</table>

<script>
$('#tableCategorias').bootstrapTable({
    height: 600,
    idField: '0',
    url: '../ajax/buscarCategorias1.php',
    columns: [{
        field: '0',
        title: '#',
        sortable: true
    }, {
        field: '1',
        title: 'Nombre',
        sortable: true
    }, {
        field: '2',
        title: 'Descripci&oacute;n',
        sortable: true
    }, {
        field: '3',
        title: 'Acciones'
    }]
});
</script>