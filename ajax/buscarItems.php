<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
$almacen = $_SESSION['almacen'];
?>

<div id="toolbarItems">
    <button class="btn btn-info" onclick="cargar_contenido('contenido_principal','modulos/pr_items.php')" style="cursor: pointer;"><i class='la la-reply' style='color: #fff; margin-top: -5px;'></i></button>
    <button class="btn btn-primary" data-toggle='modal' data-target='#nuevoItem' style="cursor: url(../img/company/cursorH1.png), pointer;"><i class='la la-plus' style='color: #fff; margin-top: -5px;'></i></button>
    <button class="btn btn-danger" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="itemsPDF();">PDF</button>
  <button class="btn btn-success" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="itemsExcel();">Excel</button>

</div>

<table
data-toggle="table"
data-toolbar="#toolbarItems"
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
id="tableItems">

</table>
<script>
$('#tableItems').bootstrapTable({
    height: 600,
    idField: '0',
    url: '../ajax/buscarItems1.php',
    columns: [{
        field: '0',
        title: '#',
        sortable: true
    }, {
        field: '1',
        title: 'Foto'
    }, {
        field: '2',
        title: 'C&oacute;digo SUNAT',
        sortable: true
    }, {
        field: '3',
        title: 'Barras',
        sortable: true
    }, {
        field: '4',
        title: 'Nombre',
        sortable: true
    }, {
        field: '5',
        title: 'Stock',
        sortable: true
    }, {
        field: '6',
        title: 'Precio',
        sortable: true
    }, {
        field: '7',
        title: 'IGV',
        sortable: true
    }, {
        field: '8',
        title: 'Acciones'
    }]
});
</script>