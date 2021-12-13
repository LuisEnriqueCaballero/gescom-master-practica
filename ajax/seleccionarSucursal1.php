<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
include("../config/db.php");
include("../config/conexion.php");
include("../config/general.php");
$sql = "select * from sucursales order by sucursal_id asc";
$query = mysqli_query($con,$sql);
$categoriaData = array();
$a1 = 1;

//$host= $_SERVER["HTTP_HOST"];
$url = $ruta;
$a   = $url;

while ($row = mysqli_fetch_array($query)) {
    $sucursal_id            = $row['sucursal_id'];
    $sucursal_nombre        = $row['sucursal_nombre'];
    $sucursal_direccion     = $row['sucursal_direccion'];
    $sucursal_tienda        = $row['sucursal_tienda'];

    for($i = 1 ;$i<=$sucursal_tienda;$i++){
      $tienda_actual = "window.open('modulos/ss_tienda.php?t=".$i."&a=".$a."','_self')";
    }

    $categoriaData['data'][] = array (
        0 => $a1++,
        1 => $sucursal_nombre,
        2 => $sucursal_direccion,
        3 => '<a class="btn btn-primary btn-sm" onclick="'.$tienda_actual.'"" style="color:#fff; cursor:pointer;">Seleccionar</a>'
    );
}
$json_string = json_encode($categoriaData);
echo $json_string;