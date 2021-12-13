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
$tienda1 = $_SESSION['tienda'];

$sql = "select * from marcas where marca_sucursal='$tienda1' order by marca_id desc";
$query = mysqli_query($con, $sql);

$marcaData = array();

while ($row = mysqli_fetch_array($query)) {
    $marca_nombre = $row['marca_nombre'];
    $marca_descripcion = $row['marca_descripcion'];

    $marcaData['data'][] = array(
        0 => $marca_nombre,
        1 => $marca_descripcion
    );
}

$json_string = json_encode($marcaData);

echo $json_string;

phpinfo();
