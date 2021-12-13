<?php
//$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
//if ($action == 'ajax') {
    /* Connect To Database*/
    session_start();
    require_once "../../config/general.php";
    require_once "../../config/db.php";
    require_once "../../config/conexion.php";
//Archivo de funciones PHP
    include "../../view/funciones/funciones.php";
    $periodo2 = date("Y");
$id_moneda1 = 151;
//Carga datos
if(isset($periodo2)){ 
    $txt_mes = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4"  => "Abril", "5"  => "Mayo", "6"  => "Junio","7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre",
    );
    $graficoBarrasData = array();
    $mes = date('m');
    $mes1 = explode('0', $mes);
    $actual = $mes1[1];
    for ($inicio = 1; $inicio <= $actual; $inicio++) {
        $mes            = $txt_mes[$inicio]; //Obtengo la abreviatura del mes
        $boleta         = montoBoleta('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el  monto de los ingresos
        $factura        = montoFactura('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el monto de los egresos
        $nCredito       = montoNC('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el monto de los egresos
        $nDebito        = montoND('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el monto de los egresos
        $anulaciones    = montoBaja('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el monto de los egresos
        $gRemision      = montoGuia('guia', $inicio, $periodo2, $id_moneda1); //Obtengo el monto de los egresos
        $nPedido        = montoNPedido('facturas', $inicio, $periodo2, $id_moneda1); //Obtengo el  monto de los ingresos
        $graficoBarrasData[] = array(
          "y" => $mes,
          "a" => $boleta,
          "b" => $factura,
          "c" => $nCredito,
          "d" => $nDebito,
          "e" => $anulaciones,
          "f" => $gRemision,
          "g" => $nPedido
        );
    }
    $json_graficoBarras = json_encode($graficoBarrasData);
}
/*{
period: 'Enero',
dl: 77,
up: 25,
ct: 20
}*/