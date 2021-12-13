<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
?>
<div id="toolbarBancos">
    <button class="btn btn-secondary bg-white" data-toggle='modal' data-target='#nuevoBanco' style="cursor: url(../img/company/cursorH1.png), pointer;">Nuevo Banco</button>
</div>
<table
data-toggle="table"
data-toolbar="#toolbarBancos"
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
id="tableBancos">

</table>

<script>
$('#tableBancos').bootstrapTable({
    height: 600,
    idField: '0',
    url: '../ajax/buscarBancos1.php',
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
        title: 'Acciones'
    }]
});
</script>