<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
?>
<div id="toolbarProveedores">
    <button data-toggle="modal" data-target="#nuevoProveedor" class="btn btn-primary" style="cursor: url(../img/company/cursorH1.png), pointer;"><i class='la la-plus' style='color: #fff; margin-top: -5px;'></i></button>
    <button class="btn btn-danger" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="proveedoresPDF();">PDF</button>
   <button class="btn btn-success" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="proveedoresExcel();">Excel</button>
</div>
<table data-toggle="table"
       data-toolbar="#toolbarProveedores"
       data-url="../ajax/buscarProveedores1.php"
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
       id="tableProveedores">
    <thead>
        <tr>
            <th data-field="0" data-align="center" data-sortable="true">#</th>
            <th data-field="1" data-sortable="true">Tipo</th>
            <th data-field="2" data-sortable="true">Documento</th>
            <th data-field="3" data-sortable="true">Nombres</th>
            <th data-field="4" data-sortable="true">Tel&eacute;fono</th>
            <th data-field="5" data-align="center" data-sortable="true">Acciones</th>
        </tr>
    </thead>
</table>
<script>
  $(function() {
    $('#tableProveedores').bootstrapTable({
      height: 600
    })
  })
</script>