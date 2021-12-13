<?php
session_start();
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/

echo "<script>alert('aaaaa');</script>";
include("../config/db.php");
include("../config/conexion.php");
$tienda1=$_SESSION['tienda'];

echo "<script>alert('aaaaa');</script>";
$almacen = $_SESSION['almacen'];
if (empty($_POST['id_proveedor'])) {
    $errors[] = "ID vacío";
    echo "<script>alert('aaaaa');</script>";
} else if (!empty($_POST['id_proveedor'])) {
    $id_proveedor     = intval($_POST['id_proveedor']);
    echo "<script>alert(".$id_proveedor.");</script>";
$sql = "select * from productos where id_proveedor=$id_proveedor order by producto_id desc";
$query = mysqli_query($con,$sql);
$productoData = array();
//Sesion de la empresa logueada
$empresa = 1;
//Datos de la empresa activa
$sql_empresa=mysqli_query($con,"select * from datosempresa where datosEmpresa_id=$empresa");
$rw_tienda=mysqli_fetch_array($sql_empresa);
$datosEmpresa_ruc=$rw_tienda['datosEmpresa_ruc'];
$user_id                = $_SESSION['usuario_id'];

$a1 = 1;
while ($row = mysqli_fetch_array($query)) {
    $producto_id           = $row['producto_id'];
    $producto_codigo       = $row['producto_codigo'];
    $producto_nombre       = $row['producto_nombre'];
    $producto_precio       = $row['producto_precio'];
    $producto_idMarca      = $row['producto_idMarca'];
    $producto_idCategoria  = $row['producto_idCategoria'];
    $producto_codigoBarras = $row['producto_codigoBarras'];
    $producto_stock        = $row['producto_stock'];
    $producto_foto         = $row['producto_foto'];
    $producto_afectacion   = $row['producto_afectacion'];
    $producto_descripcion   = $row['producto_descripcion'];
    $producto_idUnidadMedida   = $row['producto_idUnidadMedida'];
    $producto_fechaVencimiento   = $row['producto_fechaVencimiento'];
    $producto_idProveedor   = $row['producto_idProveedor'];
    $producto_monVenta   = $row['producto_monVenta'];
    $producto_costo   = $row['producto_costo'];
    $producto_minimo   = $row['producto_minimo'];
    $producto_icbper   = $row['producto_icbper'];

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $producto_fechaVencimiento;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha)); 

    if ($producto_fechaVencimiento == '0000-00-00') {
      $Mes_Anyo = '----';
      $producto_fechaVencimiento1 = "1";
    } else {
      $Mes_Anyo = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));
      $producto_fechaVencimiento1 = "2";
    }

    

    $sql_categoria=mysqli_query($con,"select * from categorias where categoria_id='".$producto_idCategoria."'");
    $rw_categoria=mysqli_fetch_array($sql_categoria);
    $categoria_nombre=$rw_categoria['categoria_nombre'];

    $sql_marca=mysqli_query($con,"select * from marcas where marca_id='".$producto_idMarca."'");
    $rw_marca=mysqli_fetch_array($sql_marca);
    $marca_nombre=$rw_marca['marca_nombre'];

    $sql_tipo_afectacion=mysqli_query($con,"select * from tipo_afectacion where tipoafectacion_id='".$producto_afectacion."'");
    $rw_tipo_afectacion=mysqli_fetch_array($sql_tipo_afectacion);
    $tipoafectacion_nombre=$rw_tipo_afectacion['tipoafectacion_nombre'];
    $tipoafectacion_id=$rw_tipo_afectacion['tipoafectacion_id'];

    if ($tipoafectacion_id <= 8) {
      $igv = 'S&Iacute;';
    }
    if ($tipoafectacion_id >= 9) {
      $igv = 'NO';
    }

    if ($producto_monVenta == 115) {
      $moneda = "S/ ";
    }
    if ($producto_monVenta == 151) {
      $moneda = "$ ";
    }

    if ($producto_foto == 'nuevo.jpg') {
      $rutaFoto = "<img src='../img/products/nuevo.jpg' class='img-fluid' width='35' alt='".$producto_codigo."'>";
      $rutaFoto1 = "<img class='media-object img-lg' src='../img/products/nuevo.jpg' alt='".$producto_nombre."'>";
    }
    if ($producto_foto != 'nuevo.jpg') {
      $rutaFoto = "<img src='../img/products/".$datosEmpresa_ruc."/".$producto_foto."' class='img-fluid' width='35' alt='".$producto_codigo."'>";
      $rutaFoto1 = "<img class='media-object img-lg' src='../img/products/".$datosEmpresa_ruc."/".$producto_foto."' alt='".$producto_nombre."'>";
    }

    $productoData['data'][] = array (
        0 => $a1++,
        1 => $rutaFoto,
        2 => $producto_codigo,
        3 => $producto_codigoBarras,
        4 => $producto_nombre,
        5 => $producto_stock,
        6 => $moneda."".number_format($producto_precio,2),
        7 => $igv,
        8 => $igv
    );
    } 
}
$json_string = json_encode($productoData);
echo $json_string;