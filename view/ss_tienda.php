<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
session_start();
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos

function recoge1($var) {
    $tmp = (isset($_REQUEST[$var])) ? trim(strip_tags($_REQUEST[$var])) : '';
    if(function_exists("get_magic_quotes_gpc") /*&&  get_magic_quotes_gpc()*/) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
    $tmp = str_replace('í', '&iacute;', $tmp);
    return $tmp;
}

$t = recoge1('t');
$a = recoge1('a');

$_SESSION['tienda'] = $t;

$sql_almacen = mysqli_query($con, "select * from almacenes where almacen_idSucursal='$_SESSION[tienda]'");
$rw_almacen = mysqli_fetch_array($sql_almacen);
$almacen_id = $rw_almacen['almacen_id'];

$_SESSION['almacen'] = $almacen_id;

/*if ($t==1) {
    $_SESSION['tienda']=1;
}
if ($t==2) {
    $_SESSION['tienda']=2;
}
if ($t==3) {
    $_SESSION['tienda']=3;
}
if ($t==4) {
    $_SESSION['tienda']=4;
}
if ($t==5) {
    $_SESSION['tienda']=5;
}
if ($t==6) {
    $_SESSION['tienda']=6;
}
if ($t==7) {
    $_SESSION['tienda']=7;
}
if ($t==8) {
    $_SESSION['tienda']=8;
}
if ($t==9) {
    $_SESSION['tienda']=9;
}
if ($t==10) {
    $_SESSION['tienda']=10;
}*/

header("location:$a"); 

//echo $tienda;
