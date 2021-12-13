<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../config/db.php";
require_once "../config/conexion.php";
$tienda = $_SESSION['tienda'];
$almacen = $_SESSION['almacen'];
$query_id = mysqli_query($con, "SELECT RIGHT(producto_codigoBarras,6) as codigo FROM productos WHERE producto_idSucursal=$almacen ORDER BY producto_codigoBarras DESC LIMIT 1")
or die('error ' . mysqli_error($con));
$count = mysqli_num_rows($query_id);

if ($count != 0) {

    $data_id = mysqli_fetch_assoc($query_id);
    $codigo  = $data_id['codigo'] + 1;
} else {

	$sql_almacen1=mysqli_query($con,"select * from almacenes where almacen_id=$almacen");
	$rw_almacen1=mysqli_fetch_array($sql_almacen1);
	$almacen_orden=$rw_almacen1['almacen_orden'];

    $codigo = $almacen_orden;
}

$buat_id = str_pad($codigo, 5, STR_PAD_LEFT);
$codigo  = "$buat_id";

echo '<input type="text" class="form-control" id="producto_codigoBarras" name="producto_codigoBarras" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="C&oacute;digo Barras" value="'.$codigo.'" required>';