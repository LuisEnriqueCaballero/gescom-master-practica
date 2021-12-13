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
    $periodo1 = date("Y");
    $id_moneda = 151;

if(isset($periodo1)){ 
    $txt_mes = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4"  => "Abril", "5"  => "Mayo", "6"  => "Junio","7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre",
    ); //Arreglo que contiene las abreviaturas de los meses del año

    //$chart_data = '';
    $categorias = array();
    //$categorias[] = array('period', "up", "dl", "ct"); //Nombre de la primer fila del grafico
    for ($inicio = 1; $inicio <= 12; $inicio++) {
        $mes          = $txt_mes[$inicio]; //Obtengo la abreviatura del mes
        $Venta        = montoVenta('facturas', $inicio, $periodo1, $id_moneda); //Obtengo el  monto de los ingresos
        $factura      = montoCompra('facturas_compras', $inicio, $periodo1, $id_moneda); //Obtengo el monto de los egresos
        $cotizaciones = montoCotizacion('facturas_cotizaciones', $inicio, $periodo1, $id_moneda); //Obtengo el monto de los egresos
        $Pedido       = montoPedido('facturas', $inicio, $periodo1, $id_moneda);
        $categorias[] = array(
          "period" => $mes,
          "up" => $Venta,
          "dl" => $factura,
          "ct" => $cotizaciones,
          "np" => $Pedido
        ); //Agrego elementos al arreglo
        //$chart_data .= "{period: '".$mes."', up: ".$Venta.", dl: ".$factura.", ct: ".$cotizaciones."}, ";
        

    }
    $json_string = json_encode($categorias); //Convierto el arreglo a formato json
    //echo "'".$mes."'";
    echo $json_string;
    //$chart_data = substr($chart_data, 0, -2);
    //echo $chart_data;

//}
}
/*{
period: 'Enero',
dl: 77,
up: 25,
ct: 20
}*/