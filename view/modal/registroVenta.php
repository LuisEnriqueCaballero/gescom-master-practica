<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos

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

<form method="post" id="guardar_venta" name="guardar_venta" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Venta</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                  <label for="cliente_tipo">Tipos de Venta *</label><br>
                      <table>
                      <tr>
                      <th><button type="button" data-dismiss="modal" class="btn btn-primary btn-sm"  onclick="cargar_contenido('contenido_principal','../modulos/vv_newVentaA.php?almacen=<?php echo $almacen_id; ?>')">A</button></th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Comprobante-Boucher-Verificacion de pago-Despacho -Conformidad</th>
                        </tr>
                        <tr style="height:20px;"></tr>
                      <tr>
                      <th><button type="button" class="btn btn-primary btn-sm" onclick="abrirVenta(2)">B</button></th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Boucher-Comprobante-Verificacion de pago- Despacho - Conformidad&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr><tr style="height:20px;"></tr>
                      <tr>
                      <th><button type="button" class="btn btn-primary btn-sm" onclick="abrirVenta(3)">C</button></th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Comprobante-Despacho-Boucher-Verificacion de pago-Conformidad&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr><tr style="height:20px;"></tr>
                      <tr>
                      <th><button type="button" class="btn btn-primary btn-sm" onclick="abrirVenta(4)">D</button></th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Comprobante-Despacho-Conformidad-Boucher-Verificacion de pago&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                      </table>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary" id="guardar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>
<script>
 function abrirVenta(num){
    $('#resultados_ajax2').html(1);
    $('#nuevoVenta').attr('disabled', false);
    
 }
</script>