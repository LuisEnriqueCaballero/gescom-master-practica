<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_cliente'])) {
    $errors[] = "ID VACIO";
} else if (!empty($_POST['id_cliente'])) {
    /* Connect To Database*/
    require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
    require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
    require_once "../view/funciones/funciones.php";
    require_once "../view/pdf/documentos/funciones.php";
    require "../view/pdf/documentos/phpqrcode/qrlib.php";
    //require_once(dirname(__FILE__).'../view/pdf/html2pdf.class.php');
    $session_id     = session_id();
    //$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
//Comprobamos si hay archivos en la tabla temporal
    $sql_count = mysqli_query($con, "select * from tmpcotizaciones where tmpCotizaciones_session='".$session_id."'");
    $count     = mysqli_num_rows($sql_count);
    if ($count == 0) {
        echo "<script>toastr['warning']('No se agregaron items', 'Aviso!');</script>";
        exit;
    }
    // escaping, additionally removing everything that could be (html/javascript-) code
    $tienda2        = $_SESSION['tienda'];
    $id_cliente     = intval($_POST['id_cliente']);
    $id_comp        = intval($_POST['id_comp']);
    $tipoCambio     = intval($_POST['tipoCambio']);
    $terminos       = $_POST['terminos'];
    $valorTipoCambio= $_POST['valorTipoCambio'];
    $id_vendedor    = intval($_SESSION['usuario_id']);
    $users          = intval($_SESSION['usuario_id']);
    $condiciones    = mysqli_real_escape_string($con, (strip_tags($_POST['condiciones'], ENT_QUOTES)));
    $factura_observaciones    = htmlspecialchars($_POST['factura_observaciones']);
    $factura_folio  = mysqli_real_escape_string($con, (strip_tags($_POST["factura_folio"], ENT_QUOTES)));
    $factura_correlativo = $_POST['factura_correlativo'];

    $factura_correlativo1=str_pad($factura_correlativo, 8, "0", STR_PAD_LEFT);

    //$trans          = mysqli_real_escape_string($con, (strip_tags($_REQUEST["trans"], ENT_QUOTES)));
    $fecha          = $_POST['factura_fecha'];
    $fechaV         = $_POST['factura_fechaVencimiento'];
    $hora           = $_POST['factura_hora'];
    $fecha1         = date("Y-m-d", strtotime($fecha) );
    $date_added     = $fecha1." ".$hora;
    //$date_added     = date("Y-m-d H:i:s");

//Seleccionamos el ultimo compo numero_fatura y aumentamos una
    /*$sql        = mysqli_query($con, "select LAST_INSERT_ID(id_factura) as last from facturas order by id_factura desc limit 0,1 ");
    $rw         = mysqli_fetch_array($sql);
    $id_factura = $rw['last'] + 1;*/
// finde la ultima fatura
    //Control de la  numero_fatura y aumentamos una
    /*$query_id = mysqli_query($con, "SELECT RIGHT(factura_correlativo,6) as factura FROM facturas ORDER BY factura DESC LIMIT 1")
    or die('error '.mysqli_error($con));
    $count = mysqli_num_rows($query_id);

    if ($count != 0) {

    $data_id = mysqli_fetch_assoc($query_id);
    $factura = $data_id['factura'] + 1;
    } else {
    $factura = 1;
    }

    $buat_id = str_pad($factura, 6, "0", STR_PAD_LEFT);
    $factura = "CFF-$buat_id";*/
// fin de numero de fatura
    // consulta principal
$nums                = 1;
$impuesto            = 18;
$sumador_total       = 0;
$sum_total           = 0;
$t_iva               = 0;
$op_exonerada        = 0;
$op_gravada          = 0;
$sumaigv             = 0;
$op_inafecta         = 0;

$sumaigv1            = 0;
$sumaigv2            = 0;
$sumaigv3            = 0;

    $medida        = "NIU";//medida del producto en unidades
    $sql           = mysqli_query($con, "select * from productos, tmpcotizaciones where productos.producto_id=tmpcotizaciones.tmpCotizaciones_idProducto and tmpcotizaciones.tmpCotizaciones_session='".$session_id."'");
    while ($row = mysqli_fetch_array($sql)) {
        $tmpCotizacion_id    = $row["tmpCotizaciones_id"];
        $producto_id     = $row['producto_id'];
        $codigo_producto = $row['producto_codigo'];
        $cantidad        = $row['tmpCotizaciones_cantidad'];
        $desc_tmp        = $row['tmpCotizaciones_descuento'];
        $nombre_producto = $row['producto_nombre'];
        $producto_igv    = $row['producto_igv'];
        $cat_pro1        = $row['producto_idCategoria'];
        $producto_idUnidadMedida = $row['producto_idUnidadMedida'];

        $producto_icbper = $row['producto_icbper'];

        $unidades=mysqli_query($con, "select * from unidadmedida where unidadMedida_id='".$producto_idUnidadMedida."'");
        $row_und=mysqli_fetch_array($unidades);
        $und_pro1=$row_und["unidadMedida_xml"];
        // control del impuesto por productos.
        /*if ($row['iva_producto'] == 0) {
            $p_venta   = $row['tmpCotizacion_precio'];
            $p_venta_f = number_format($p_venta, 2); //Formateo variables
            $p_venta_r = str_replace(",", "", $p_venta_f); //Reemplazo las comas
            $p_total   = $p_venta_r * $cantidad;
            $f_items   = rebajas($p_total, $desc_tmp); //Aplicando el descuento
           
            $p_total_f = number_format($f_items, 2); //Precio total formateado
            $p_total_r = str_replace(",", "", $p_total_f); //Reemplazo las comas

            $sum_total += $p_total_r; //Sumador
            $t_iva = ($sum_total * $impuesto) / 100;
            $t_iva = number_format($t_iva, 2, '.', '');
        }*/
        //end impuesto

        /*if ($producto_icbper == 2) {
            $df_icbper = $cantidad*0.2;
        }*/

        $precio_venta   = $row['tmpCotizaciones_precio'];
        $costo_producto = $row['producto_costo'];
        $precio_venta_f = number_format($precio_venta, 2); //Formateo variables
        $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
        $precio_total   = $precio_venta_r * $cantidad;
        $final_items    = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
        /*--------------------------------------------------------------------------------*/
        $precio_total_f = number_format($final_items, 2); //Precio total formateado
        $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
        $sumador_total += $precio_total_r; //Sumador
        //Comprobamos que el dinero Resibido no sea menor al Totalde la factura

        $igv=0.18;
        $cantidad1[$nums]=$cantidad;
        $und_pro[$nums]=$und_pro1;
        $tipo_cantidad[$nums]=$medida;
        $precio_unitario[$nums]=$precio_venta;
        $a=1.18;
        $valor_unitario[$nums]=round($precio_venta/$a,2);
        $total_producto[$nums]=round($valor_unitario[$nums]*$cantidad,2);
        $total_igv[$nums]=round($igv*$total_producto[$nums],2);
        $producto[$nums]=$nombre_producto;
        $codigo[$nums]=$codigo_producto;

        //$cantidad1[$nums]=$cantidad;
        $cat_pro[$nums]=$producto_icbper;
        //$und_pro[$nums]=$und_pro1;
        if ($producto_igv == 1) {
            $op_gravada+= $precio_total_r/1.18;
            $sumaigv1=0.18*($op_gravada);
        }
        if ($producto_igv == 2) {
            $op_exonerada+= $precio_total_r;
            $sumaigv2=0;
        }
        if ($producto_igv == 3) {
            $op_inafecta+= $precio_total_r;
            $sumaigv3=0;
        }

        $sumaigv = $sumaigv1;

        //Insert en la tabla detalle_factura
        $insert_detail = mysqli_query($con, "INSERT INTO detallecotizacion VALUES 
            (NULL,
            '$factura_folio',
            '$factura_correlativo',
            '$producto_id',
            '$cantidad',
            '$precio_venta',
            '$tienda2',
            '1',
            '$id_cliente',
            '$id_vendedor',
            '$id_comp',
            '$desc_tmp',
            '$op_gravada',
            '$op_exonerada',
            '$op_inafecta',
            '0',
            '$sumaigv1'
            )");

        $nums++;
    }
    // Fin de la consulta Principal
    $subtotal         = number_format($sumador_total, 2, '.', '');
    $total_iva        = ($subtotal * $impuesto) / 100;
    $total_iva        = number_format($total_iva, 2, '.', '') - number_format($t_iva, 2, '.', '');
    $total_factura    = $subtotal/* + $total_iva*/;
    //$camb             = number_format($cambio, 2);
    //$acuent             = number_format($acuenta, 2);

    $documento = mysqli_query($con, "UPDATE seriescorrelativos SET serieCorrelativo_numero=$factura_correlativo WHERE serieCorrelativo_idTipoComprobante=$id_comp");

    $insert = mysqli_query($con, "INSERT INTO facturas_cotizaciones VALUES 
        (NULL,
        '$factura_correlativo',
        '$date_added',
        '$id_cliente',
        '$id_vendedor',
        '$condiciones',
        '$total_factura',
        '1',
        '$tienda2',
        '1',
        '$tipoCambio',
        '$fechaV',
        '$terminos',
        '$factura_folio',
        '$id_comp',
        '$factura_observaciones',
        '$op_gravada',
        '$op_inafecta',
        '$op_exonerada',
        '$sumaigv',
        '0',
        '$valorTipoCambio',
        '2018-11-11'
        )");
    $delete = mysqli_query($con, "DELETE FROM tmpcotizaciones WHERE tmpCotizaciones_session='".$session_id."'");

    $accion1=mysqli_query($con, "select * from facturas_cotizaciones where cotizacion_correlativo='".$factura_correlativo."' and cotizacion_folio='".$factura_folio."' and cotizacion_tipo='".$id_comp."' and cotizacion_sucursal=$tienda2");
    $row1=mysqli_fetch_array($accion1);
    $id_factura=$row1["cotizacion_id"];

    if ($insert_detail) {
        echo "<script>$('#modal_vuelto').modal('show');</script>";
        #$messages[] = "Venta  ha sido Guardada satisfactoriamente.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {

    ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
foreach ($errors as $error) {
        echo $error;
    }
    ?>
    </div>
    <?php
}
if (isset($messages)) {

    ?>
    <div class="alert alert-success" role="alert">
        <strong>¡Bien hecho!</strong>
        <?php
foreach ($messages as $message) {
        echo $message;
    }
    ?>
    </div>
    <?php
}

?>
<!-- Modal -->

<div class="modal fade" id="modal_vuelto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo "Cotizaci&oacute;n Electr&oacute;nica: ".$factura_folio."-".$factura_correlativo1; ?></h5>
        </div>
        <hr>
        <div class="m-b-15">
            <button type="button" id="imprimir" class="btn btn-primary btn-rounded btn-block" onclick="imprimir_facturas3('<?php echo $id_factura;?>');" accesskey="t" ><span class="fa fa-print"></span> Imprimir Ticket</button>
            <button type="button" id="imprimir2" class="btn btn-success btn-rounded btn-block" onclick="imprimir_facturas2('<?php echo $id_factura;?>');" accesskey="p"><span class="fa fa-print"></span> Imprimir A4</button>
            <!--<button type="button" id="imprimir3" class="btn btn-secondary btn-block btn-lg waves-effect waves-light"><span class="fa fa-envelope"></span> Enviar Correo</button>-->
            <button type="button" class="btn btn-secondary btn-rounded btn-block" onclick="recargar();" data-dismiss="modal" aria-label="Close"><span class="fa fa-plus"></span> Nueva Cotizaci&oacute;n</button>
        </div>
     </div>
  </div>
</div>