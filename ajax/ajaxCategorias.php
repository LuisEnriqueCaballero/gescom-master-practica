<?php
include 'is_logged.php';
require_once "../config/db.php";
require_once "../config/conexion.php";

$tienda = $_SESSION['tienda'];
$sql_segmento ="select * from categorias where (categoria_sucursal='$tienda' or categoria_sucursal=0) order by categoria_id desc";
echo '<select name="producto_idCategoria" id="producto_idCategoria" class="select2 form-control" style="width: 100%; text-align: left;" required>';
$row          =mysqli_query($con,$sql_segmento);
    while ($row4 = mysqli_fetch_array($row)) {
    $categoria_nombre = $row4["categoria_nombre"];
    $categoria_id     = $row4["categoria_id"];
echo '<option value="'.$categoria_id.'">'.$categoria_nombre.'</option>';
}
echo '</select>';
?>