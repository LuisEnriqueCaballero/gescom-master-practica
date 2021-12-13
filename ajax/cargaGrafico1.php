<?php 
// MySQL database connection code
//include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
session_start();
require_once "../config/db.php";
require_once "../config/conexion.php";
//Fetch productos data
$tienda = $_SESSION['tienda'];
$sql = "select count(detallefactura.detalleFactura_cantidad) as unidades_vendidas from detallefactura, productos where detalleFactura.detalleFactura_idProducto=productos.producto_id and detalleFactura.detalleFactura_sucursal='$tienda'";
$query = mysqli_query($con,$sql);
//$result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));
//create an array
$array = array();
$i = 0;
while($row = mysqli_fetch_array($query))
{  
    $producto = $row['producto_nombre'];
    $unidades_vendidas = $row['unidades_vendidas'];
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)) );
}
$data = json_encode($array);
echo $data;
?>