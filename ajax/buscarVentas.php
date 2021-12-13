<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos

$user_id = $_SESSION['usuario_id'];
$tienda  = $_SESSION['tienda'];

$sql = "select * from almacenes where almacen_idSucursal='$tienda' and almacen_activo='1' order by almacen_id asc";
$query = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($query)) {
    $almacen_id = $row['almacen_id'];
    $nombre = substr($row['almacen_direccion'], 0, 28).'...';

    $user = mysqli_query($con, "select * from productos where producto_idSucursal='$almacen_id'");
    $num  = mysqli_num_rows($user);
}
?>
<div id="toolbarClientes">
  <button onclick="cargar_contenido('contenido_principal','modulos/vv_registroVenta.php?almacen=<?php echo $almacen_id; ?>')" class="btn btn-primary" style="cursor: url(../img/company/cursorH1.png), pointer;"><i class='la la-plus' style='color: #fff; margin-top: -5px;'></i></button>
  <button class="btn btn-danger" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="clientesPDF();">PDF</button>
  <button class="btn btn-success" style="cursor: url(../img/company/cursorH1.png), pointer;" onclick="clientesExcel();">Excel</button>
</div>
<table data-toggle="table"
       data-toolbar="#toolbarClientes"
       data-url="../ajax/buscarAjusteDoc1.php"
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
       id="tableAjusteDocumento">
    <thead>
        <tr>
            <th data-field="0" data-align="center" data-sortable="true">#</th>
            <th data-field="2" data-sortable="true">Nombre Doc</th>
            <th data-field="1" data-sortable="true">Descripcion</th>
            <th data-field="3" data-sortable="true"></th>
        </tr>
    </thead>
</table>
<script>
  $(function() {
    $('#tableAjusteDocumento').bootstrapTable({
      height: 600
    })
  })
</script>