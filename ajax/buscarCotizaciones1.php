<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
include("../config/db.php");
include("../config/conexion.php");
$tienda1=$_SESSION['tienda'];
$usuario=$_SESSION['usuario_id'];

$daterange   = $_GET['range'];


list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
$fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
$fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";


$sql = "select * from facturas_cotizaciones, clientes where facturas_cotizaciones.cotizacion_idCliente=clientes.cliente_id and facturas_cotizaciones.cotizacion_sucursal=$tienda1 and facturas_cotizaciones.cotizacion_correlativo>0 and facturas_cotizaciones.cotizacion_fecha between '$fecha_inicial' and '$fecha_final' order by facturas_cotizaciones.cotizacion_id desc";
$query = mysqli_query($con,$sql);
$documentosElectronicosData = array();

$user_id                = $_SESSION['usuario_id'];
//
$sql_usuario=mysqli_query($con,"select * from usuarios where usuario_id=$user_id");
$rw_usuario=mysqli_fetch_array($sql_usuario);
$usuario_accesos=$rw_usuario['usuario_accesos'];
//Validamos los accesos
//$sql_acceso             = "select * from accesos where acceso_id=$usuario_accesos";
//$rw1                    = mysqli_query($con,$sql_acceso);//recuperando el registro
//$rs1                    = mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
//$modulo                 = $rs1["acceso_permiso"];
//$a                      = explode(".", $modulo); 
$a=1;
$a1 = 1;
$estado2="";
$text_pago = "";

while ($row = mysqli_fetch_array($query)) {
    
    $cotizacion_id=$row['cotizacion_id'];
    $cotizacion_correlativo=$row['cotizacion_correlativo'];
    $fecha=date("d/m/Y", strtotime($row['cotizacion_fecha']));
    $vence=date("d/m/Y", strtotime($row['cotizacion_fechaElimina']));
    $cliente_nombre=$row['cliente_nombre'];

    $cliente_telefono=$row['cliente_telefono'];
    $cliente_documento=$row['cliente_documento'];
    $cliente_email=$row['cliente_email'];
    $cotizacion_folio=$row['cotizacion_folio'];

    $cotizacion_gravada=$row['cotizacion_gravada'];
    $cotizacion_inafecta=$row['cotizacion_inafecta'];
    $cotizacion_exonerada=$row['cotizacion_exonerada'];
    $cotizacion_igv=$row['cotizacion_igv'];

    $cotizacion_activo=$row['cotizacion_activo'];
    $cotizacion_estado=$row['cotizacion_estado'];
    $cotizacion_dias=$row['cotizacion_dias'];
    //$cotizacion_modifica=$row['cotizacion_modifica'];

    $sql_empresa=mysqli_query($con,"select * from detallecotizacion where detalleCotizacion_correlativo='".$cotizacion_correlativo."' and detalleCotizacion_folio='".$cotizacion_folio."'");
    $row6=mysqli_fetch_array($sql_empresa);
    $detallecotizacion_idProducto = $row6['detalleCotizacion_idProducto'];
    $detallecotizacion_cantidad = $row6['detalleCotizacion_cantidad'];
    $id_detalle = $row6['detalleCotizacion_folio'];

    $usuario2= mysqli_query($con, "select * from productos where producto_id='".$detallecotizacion_idProducto."'");
    $row7= mysqli_fetch_array($usuario2);
    $producto_catPro = $row7['producto_idCategoria'];

    $estado_factura1=$row['cotizacion_tipo'];

    $cotizacion_correlativo1=str_pad($cotizacion_correlativo, 8, "0", STR_PAD_LEFT);
   
    $estado_factura=$row['cotizacion_condiciones'];
    $moneda=$row['cotizacion_moneda'];

    if ($moneda==115) {
        $mon="PEN";
    }
    if ($moneda==151) {
        $mon="USD";
    }

    if ($cotizacion_activo == 1) {
        $displayA = "";
       if($estado_factura == 1) {
            $estado2="Contado";
            $text_pago = "secondary";
        }
        if($estado_factura == 2) {
            $estado2="Cheque";
            $text_pago = "secondary";
            
        }
        if($estado_factura == 3) {
            $estado2="Transf Bancaria";
            $text_pago = "secondary";
        }
        if($estado_factura == 4) {
            $estado2="Cr&eacute;dito";
            $text_pago = "warning";
        }
    }
    if ($cotizacion_activo <> 1) {
        $displayA = "none";
        $estado2="Anulado";
        $text_pago = "danger";
    }
    
    if($estado_factura1==9){
        $estado1="Cotizaci&oacute;n";
        $total_venta=$row['cotizacion_ventaTotal'];
        
    }
    $conve = '';
    if ($cotizacion_estado == 1) {
        $txt_cot = "pink";
        $factura_cot = "Sin Facturar";
        if ($a[71]==1) {
            $conve = '<li><a style="cursor: url(../img/company/cursorH1.png), pointer; display: '.$displayA.'" href="#/co_convertir.php?cot='.$cotizacion_id.'"><img src="../assets/images/svg-icon/sunat.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Facturar</a></li>';
        }

    }
    if ($cotizacion_estado == 2) {
        $txt_cot = "mint";
        $factura_cot = "Facturado: ".$cotizacion_modifica;
        if ($a[71]==1) {
            $conve = '<li><a style="cursor: url(../img/company/cursorH1.png), pointer; display: none;"><img src="../assets/images/svg-icon/sunat.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Facturar</a></li>';
        }

    }
    if ($cotizacion_estado == 3) {
        $txt_cot = "danger";
        $factura_cot = "Rechazado";
        if ($a[71]==1) {
            $conve = '<li><a style="cursor: url(../img/company/cursorH1.png), pointer; display: none;"><img src="../assets/images/svg-icon/sunat.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Facturar</a></li>';
        }

    }


    

    if ($cotizacion_estado == 1) {
        $displayB = "";
    }
    if ($cotizacion_estado == 2) {
        $displayB = "none";
    }


    if ($a[72]==1) {
        $eliminar = '<li><a data-toggle="modal" data-target="#eliminarDocumento" style="cursor: url(../img/company/cursorH1.png), pointer; display:'.$displayA." ".$displayB.';" data-id="'.$cotizacion_id.'"><img src="../assets/images/svg-icon/ban.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Anular</a></li>';
    } else {
        $eliminar = '';
    }


    $titulo = $cotizacion_folio."-".$cotizacion_correlativo;

    $documentosElectronicosData['data'][] = array (
        0 => $a1++,
        1 => $cotizacion_folio."-".$cotizacion_correlativo,
        2 => $estado1,
        3 => $fecha,
        4 => $cliente_nombre,
        5 => number_format ($total_venta,2),
        6 => $mon,
        7 => '<span class="badge badge-'.$text_pago.'">'.$estado2.'</span>',
        8 => $cotizacion_dias.' D&iacute;as',
        9 => '<span class="badge badge-'.$txt_cot.'">'.$factura_cot.'</span>',
        10 => '<div class="btn-group mr-2">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle bg-white" data-toggle="dropdown" type="button" style="cursor: url(../img/company/cursorH1.png), pointer;">
                      <img src="../assets/images/svg-icon/adjust.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> <i class="dropdown-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right bg-white">
                        <li><a onclick="imprimir_facturas3('.$cotizacion_id.');" style="cursor: url(../img/company/cursorH1.png), pointer;"><img src="../assets/images/svg-icon/document.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Imprimir Ticket</a></li>
                        <li><a onclick="imprimir_facturas2('.$cotizacion_id.');" style="cursor: url(../img/company/cursorH1.png), pointer;"><img src="../assets/images/svg-icon/pdf3.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Imprimir A4</a></li>
                        <li><a data-toggle="modal" data-target="#enviarCorreo" style="cursor: url(../img/company/cursorH1.png), pointer;" data-id="'.$cotizacion_id.'" data-correo="'.$cliente_email.'" data-nombre="'.$titulo.'"><img src="../assets/images/svg-icon/gmail.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Enviar Correo</a></li>
                        <li><a data-toggle="modal" data-target="#enviarWhatsApp" style="cursor: url(../img/company/cursorH1.png), pointer;" data-id="'.$cotizacion_id.'" data-telefono="'.$cliente_telefono.'" data-nombre="'.$titulo.'"><img src="../assets/images/svg-icon/whatsapp.svg" class="img-fluid" alt="settings" style="width: 15px; height: 15px;"> Enviar WhatsApp</a></li>
                        '.$conve.'
                        '.$eliminar.'
                    </div>
                </div>
            </div>'
    );
}
$json_string = json_encode($documentosElectronicosData);
echo $json_string;