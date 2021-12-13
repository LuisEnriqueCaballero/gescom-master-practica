<?php
include 'is_logged.php';
require_once "../config/db.php";
require_once "../config/conexion.php";

$tienda = $_SESSION['tienda'];
$sql_segmento ="select * from marcas where (marca_sucursal='$tienda' or marca_sucursal=0) order by marca_id desc";
echo '<select name="producto_idMarca" id="producto_idMarca" class="form-control" style="width: 100%; text-align: left;" required>';
$row          =mysqli_query($con,$sql_segmento);
    while ($row4 = mysqli_fetch_array($row)) {
    $marca_nombre = $row4["marca_nombre"];
    $marca_id     = $row4["marca_id"];
echo '<option value="'.$marca_id.'">'.$marca_nombre.'</option>';
}
echo '</select>';
?>