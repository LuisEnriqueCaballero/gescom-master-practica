<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include '../is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
$tienda1=$_SESSION['tienda'];

$id_comp = 9;

$sql         = mysqli_query($con, "select * from seriescorrelativos where serieCorrelativo_idTipoComprobante ='$id_comp' and serieCorrelativo_sucursal='$tienda1'");
$rw          = mysqli_fetch_array($sql);
$serieCorrelativo_numero1  = $rw['serieCorrelativo_numero'];
$serieCorrelativo_numero = $serieCorrelativo_numero1+1;
?>
<input type="text" class="form-control" autocomplete="off" id="factura_correlativo" name="factura_correlativo" value="<?php echo $serieCorrelativo_numero; ?>" readonly="">