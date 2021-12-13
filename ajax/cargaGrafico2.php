<?php
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    /* Connect To Database*/
    session_start();
    require_once "../config/db.php";
    require_once "../config/conexion.php";
//Archivo de funciones PHP
    include "../view/funciones/funciones.php";
    $periodo1 = intval($_REQUEST['periodo1']);
    $txt_mes = array("1" => "Ene", "2" => "Feb", "3" => "Mar", "4"  => "Abr", "5"  => "May", "6"  => "Jun",
        "7"                  => "Jul", "8" => "Ago", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dic",
    ); //Arreglo que contiene las abreviaturas de los meses del año

    $mes = date('m');
    $mes1 = explode('0', $mes);
    $actual = $mes1[1];
    $categorias[] = array('Mes', "Ventas", "Compras", "Cotizaciones"); //Nombre de la primer fila del grafico
    for ($inicio = 1; $inicio <= 12; $inicio++) {
        $mes          = $txt_mes[$inicio]; //Obtengo la abreviatura del mes
        $Venta     = montoVenta('facturas', $inicio, $periodo1); //Obtengo el  monto de los ingresos
        $factura      = montoCompra('facturas_compras', $inicio, $periodo1); //Obtengo el monto de los egresos
        $cotizaciones      = montoCotizacion('facturas_cotizaciones', $inicio, $periodo1); //Obtengo el monto de los egresos
        $categorias[] = array($mes, $Venta, $factura, $cotizaciones); //Agrego elementos al arreglo

    }
    echo json_encode(($categorias)); //Convierto el arreglo a formato json
}
