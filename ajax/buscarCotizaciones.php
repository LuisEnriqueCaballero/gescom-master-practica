<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
?>
<div id="toolbarCotizaciones">
    <a class="btn btn-secondary bg-white" href="#/co_nuevaCotizacion" style="cursor: url(../img/company/cursorH1.png), pointer;">Nueva Cotizaci&oacute;n</a>
    <button class="btn btn-secondary bg-white" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="dCotizacionPDF();">PDF</button>
    <button class="btn btn-secondary bg-white" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="dCotizacionExcel();">Excel</button>
</div>
<table
data-toggle="table"
data-toolbar="#toolbarCotizaciones"
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
id="tableCotizaciones">

</table>

<script>
var range=$("#range").val();
$('#tableCotizaciones').bootstrapTable({
    height: 600,
    idField: '0',
    url: '../ajax/buscarCotizaciones1.php?range=' + range,
    columns: [{
        field: '0',
        title: '#',
        sortable: true
    }, {
        field: '1',
        title: 'Doc',
        sortable: true
    }, {
        field: '3',
        title: 'Fecha',
        sortable: true
    }, {
        field: '4',
        title: 'Cliente',
        sortable: true
    }, {
        field: '5',
        title: 'Total',
        sortable: true
    }, {
        field: '6',
        title: 'Moneda',
        sortable: true
    }, {
        field: '7',
        title: 'Pago',
        sortable: true
    }, {
        field: '8',
        title: 'D&iacute;as',
        sortable: true
    }, {
        field: '9',
        title: 'Estado',
        sortable: true
    }, {
        field: '10',
        title: 'Acciones'
    }]
});
</script>