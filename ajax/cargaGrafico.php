<?php
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    /* Connect To Database*/
    session_start();
    require_once "../config/db.php";
    require_once "../config/conexion.php";
//Archivo de funciones PHP
    include "../view/funciones/funciones.php";
    $periodo = intval($_REQUEST['periodo']);
    $txt_mes = array("1" => "Ene", "2" => "Feb", "3" => "Mar", "4"  => "Abr", "5"  => "May", "6"  => "Jun",
        "7"                  => "Jul", "8" => "Ago", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dic",
    ); //Arreglo que contiene las abreviaturas de los meses del año

    $categorias[] = array('Mes', "Boleta", "Factura", "N. Credito", "N. Debito", "C. Baja", "Guia R."); //Nombre de la primer fila del grafico

    $mes = date('m');
    $mes1 = explode('0', $mes);
    $actual = $mes1[1];
    for ($inicio = 1; $inicio <= $actual; $inicio++) {
        $mes          = $txt_mes[$inicio]; //Obtengo la abreviatura del mes
        $boleta     = montoBoleta('facturas', $inicio, $periodo); //Obtengo el  monto de los ingresos
        $factura      = montoFactura('facturas', $inicio, $periodo); //Obtengo el monto de los egresos
        $nCredito      = montoNC('facturas', $inicio, $periodo); //Obtengo el monto de los egresos
        $nDebito      = montoND('facturas', $inicio, $periodo); //Obtengo el monto de los egresos
        $anulaciones      = montoBaja('facturas', $inicio, $periodo); //Obtengo el monto de los egresos
        $gRemision      = montoGuia('guia', $inicio, $periodo); //Obtengo el monto de los egresos
        $categorias[] = array($mes, $boleta, $factura, $nCredito, $nDebito, $anulaciones, $gRemision); //Agrego elementos al arreglo

    }
    echo json_encode(($categorias)); //Convierto el arreglo a formato json
}
