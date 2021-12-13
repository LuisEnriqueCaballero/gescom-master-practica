<?php
/*-------------------------
Autor: Delmar Lopez
Web: www.softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id = session_id();
if (isset($_POST['id'])) {$id = $_POST['id'];}
if (isset($_POST['cantidad'])) {$cantidad = $_POST['cantidad'];}
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../view/funciones/funciones.php";

if (!empty($id) and !empty($cantidad)) {
    $producto_id  = get_row('productos', 'producto_id', 'producto_codigoBarras', $id);
    $precio_venta = get_row('productos', 'producto_precio', 'producto_id', $producto_id);

    // consulta para comparar el stock con la cantidad resibida
    $query = mysqli_query($con, "select producto_stock, producto_inventario from productos where producto_id = '$producto_id'");
    $rw    = mysqli_fetch_array($query);
    $stock = $rw['producto_stock'];
    $inv   = $rw['producto_inventario'];

    //Comprobamos si ya agregamos un producto a la tabla tmp_compra
    $comprobar = mysqli_query($con, "select * from tmpcotizaciones, productos where productos.producto_id = tmpcotizaciones.tmpCotizaciones_idProducto and  tmpcotizaciones.tmpCotizaciones_idProducto='" . $producto_id . "' and tmpCotizaciones_session='" . $session_id . "'");

    if ($row = mysqli_fetch_array($comprobar)) {
        $cant = $row['tmpCotizaciones_cantidad'] + $cantidad;
        // condicion si el stock e menor que la cantidad requerida
        if ($cant > $row['producto_stock'] and $inv == 0) {
            echo "<script>toastr['warning']('No se encontr&oacute; el item', 'Aviso!');
            $('#resultados').load('../ajax/agregarTmpCotizaciones.php');
        </script>";
            exit;
        } else {

            $sql          = "UPDATE tmpcotizaciones SET tmpCotizaciones_cantidad='" . $cant . "' WHERE tmpCotizaciones_idProducto='" . $producto_id . "' and tmpCotizaciones_session='" . $session_id . "'";
            $query_update = mysqli_query($con, $sql);
        }
        // fin codicion cantaidad

    } else {
        // condicion si el stock e menor que la cantidad requerida
        if ($cantidad > $stock and $inv == 0) {
            echo "<script>toastr['warning']('No se encontr&oacute; el item', 'Aviso!');
        $('#resultados').load('../ajax/agregarTmpCotizaciones.php');
    </script>";
            exit;
        } else {

            $insert_tmp = mysqli_query($con, "INSERT INTO tmpcotizaciones (tmpCotizaciones_idProducto,tmpCotizaciones_cantidad,tmpCotizaciones_precio,tmpCotizaciones_descuento,tmpCotizaciones_session) VALUES ('$producto_id','$cantidad','$precio_venta','0','$session_id')");
                //echo "<script> toastr['success']('Item agregado', 'Bien hecho!');</script>";
        }
        // fin codicion cantaidad
    }

}
if (isset($_GET['id'])) //codigo elimina un elemento del array
{
    $tmpCotizaciones_id = intval($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM tmpcotizaciones WHERE tmpCotizaciones_id='" . $tmpCotizaciones_id . "'");
}
//$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>
<div class="table-responsive">
    <table class="table table-sm">
        <thead class="" style="border-bottom: 3px solid #232323; background: #fcfcfc;">
            <tr>
                <th class='text-center'>COD</th>
                <th class='text-center'>CANT.</th>
                <th class='text-center'>DESCRIP.</th>
                <th class='text-center'>PRECIO <!--<?php echo $simbolo_moneda; ?>--></th>
                <th class='text-center'>DESC %</th>
                <th class='text-right'>TOTAL</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
//$impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
//$nom_impuesto   = get_row('perfil', 'nom_impuesto', 'id_perfil', 1);
$sumador_total       = 0;
$total_iva           = 0;
$total_impuesto      = 0;
$subtotal            = 0;
$sumaicbper          = 0;
$total_factura_exon  = 0;
$total_factura_inaf  = 0;
$total_factura       = 0;
$op_exonerada        = 0;
$op_gravada          = 0;
$sumaigv             = 0;
$op_inafecta         = 0;

$total1              = 0;
$total2              = 0;
$total3              = 0;
$total4              = 0;
$total5              = 0;

$sumaigv1            = 0;
$sumaigv2            = 0;
$sumaigv3            = 0;

$sql            = mysqli_query($con, "select * from productos, tmpcotizaciones where productos.producto_id=tmpcotizaciones.tmpCotizaciones_idProducto and tmpcotizaciones.tmpCotizaciones_session='" . $session_id . "'");
while ($row = mysqli_fetch_array($sql)) {
    $tmpCotizaciones_id          = $row["tmpCotizaciones_id"];
    $producto_id           = $row['producto_id'];
    $producto_codigoBarras = $row['producto_codigoBarras'];
    $cantidad              = $row['tmpCotizaciones_cantidad'];
    $tmpCotizaciones_descuento   = $row['tmpCotizaciones_descuento'];
    $producto_nombre       = $row['producto_nombre'];
    $producto_icbper       = $row['producto_icbper'];
    $producto_afectacion   = $row['producto_afectacion'];
    $igv                   = $row['producto_igv'];

    

    $precio_venta   = $row['tmpCotizaciones_precio'];
    $precio_venta_f = number_format($precio_venta, 2); //Formateo variables
    $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
    $precio_total   = $precio_venta_r * $cantidad;
    $final_items    = rebajas($precio_total, $tmpCotizaciones_descuento); //Aplicando el descuento
    /*--------------------------------------------------------------------------------*/
    $precio_total_f = number_format($final_items, 2); //Precio total formateado
    $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
    $sumador_total += $precio_total_r; //Sumador
    $subtotal = number_format($sumador_total, 2, '.', '');

    $total_impuesto += rebajas($total_iva, $tmpCotizaciones_descuento) * $cantidad;

    if ($igv == 1) {
        $op_gravada+= $precio_total_r/1.18;
        $sumaigv1=0.18*($op_gravada);
    }
    if ($igv == 2) {
        $op_exonerada+= $precio_total_r;
        $sumaigv2=0;
    }
    if ($igv == 3) {
        $op_inafecta+= $precio_total_r;
        $sumaigv3=0;
    }

    $sumaigv = $sumaigv1;

    if ($producto_icbper == 2) {
        $sumaicbper=$cantidad*0.2;
    }
    if ($producto_icbper <> 2) {
        $sumaicbper = 0;
    }

    //Total gravada
    /*$suma1= mysqli_query($con, "select SUM(detalleFactura_gravada) AS total1 FROM detallefactura where detalleFactura_folio='$factura_folio' and detalleFactura_correlativo='$numero_factura'");
    $row1= mysqli_fetch_array($suma1);
    $total1 = $row1['total1'];
    //total exonerada
    $suma2= mysqli_query($con, "select SUM(detalleFactura_exonerada) AS total2 FROM detallefactura where detalleFactura_folio='$factura_folio' and detalleFactura_correlativo='$numero_factura'");
    $row2= mysqli_fetch_array($suma2);
    $total2 = $row2['total2'];
    //Total inafecta
    $suma3= mysqli_query($con, "select SUM(detalleFactura_inafecta) AS total3 FROM detallefactura where detalleFactura_folio='$factura_folio' and detalleFactura_correlativo='$numero_factura'");
    $row3= mysqli_fetch_array($suma3);
    $total3 = $row3['total3'];
    //Total venta gravada
    $suma4= mysqli_query($con, "select SUM(detalleFactura_precioVenta) AS total4 FROM detallefactura where detalleFactura_folio='$factura_folio' and detalleFactura_correlativo='$numero_factura' and detalleFactura_igvVenta='1'");
    $row4= mysqli_fetch_array($suma4);
    $total4 = $row4['total4'];
    //Total ICBPER
    $suma5= mysqli_query($con, "select SUM(detalleFactura_icbper) AS total5 FROM detallefactura where detalleFactura_folio='$factura_folio' and detalleFactura_correlativo='$numero_factura'");
    $row5= mysqli_fetch_array($suma5);
    $total5 = $row5['total5'];*/

    
    ?>
        <tr>
            <td class='text-center'><?php echo $producto_codigoBarras; ?></td>
            <td class='text-center'><?php echo $cantidad; ?></td>
            <td><?php echo $producto_nombre; ?></td>
            <td class='text-center'>
                <input type="text" class="form-control employee_id" style="text-align:center" value="<?php echo number_format($precio_venta, 2); ?>" id="<?php echo $tmpCotizaciones_id; ?>">
            </td>
            <td align="right" width="15%">
                    <input type="text" class="form-control txt_desc" style="text-align:center" value="<?php echo $tmpCotizaciones_descuento; ?>" id="<?php echo $tmpCotizaciones_id; ?>">
            </td>
            <td class='text-right'><?php echo /*$simbolo_moneda . ' ' . */number_format($final_items, 2); ?></td>
            <td class='text-center'>
                <a style="cursor: pointer;" class='btn btn-warning btn-xs' onclick="eliminar('<?php echo $tmpCotizaciones_id ?>')"><i class="fa fa-trash" style="color: #fff;"></i>
                </a>
            </td>
        </tr>

    <?php
}


$total_factura = $subtotal/1.18;
$total_iva = $total_factura*0.18;
//$total_iva = $total_factura*0.18;

//$total_factura = $subtotal1 + $total_impuesto;

?>

        </tbody>
    </table>
</div>
<div id="totalContainer" style="margin: 10px 0px; float: right; text-align: right;">
    <div class="x-panel total-summary-board x-panel-default" style="width: 400px; height: 235px;" id="displayPanel_TotalSummaryBoard-1243">
        <div id="displayPanel_TotalSummaryBoard-1243-body" class="x-panel-body x-panel-body-default x-panel-body-default" style="padding: 0px; width: 400px; left: 0px; top: 0px; height: 235px;">
            <span id="displayPanel_TotalSummaryBoard-1243-outerCt" style="display: table; width: 100%; table-layout: fixed;">
                <div id="displayPanel_TotalSummaryBoard-1243-innerCt" style="display:table-cell;height:100%;vertical-align:top;padding:30px 30px 30px 30px" class="">
                    <table class="x-field important price-row x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1747" style="table-layout: auto;">
                        <tbody>
                            <tr id="displayfield-1747-inputRow">
                                <td id="displayfield-1747-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                    <label id="displayfield-1747-labelEl" for="displayfield-1747-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><strong>Op. Gravada</strong></label>
                                </td>
                                <td class="x-form-item-body " id="displayfield-1747-bodyEl" colspan="2" role="presentation">
                                    <div id="displayfield-1747-inputEl" class="x-form-display-field" aria-invalid="false"><?php echo /*$simbolo_moneda . ' ' . */number_format($op_gravada, 2); ?></div>
                                </td>
                                <td id="displayfield-1747-sideErrorCell" valign="middle" style="display: none;" width="17">
                                    <div id="displayfield-1747-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="x-field important price-row x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1748" style="table-layout: auto;">
                        <tbody>
                            <tr id="displayfield-1748-inputRow">
                                <td id="displayfield-1748-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                    <label id="displayfield-1748-labelEl" for="displayfield-1748-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><strong>Op. Inafecta</strong></label>
                                </td>
                                <td class="x-form-item-body " id="displayfield-1748-bodyEl" colspan="2" role="presentation">
                                    <div id="displayfield-1748-inputEl" class="x-form-display-field" aria-invalid="false"><?php echo /*$simbolo_moneda . ' ' . */number_format($op_inafecta, 2); ?></div>
                                </td>
                                <td id="displayfield-1748-sideErrorCell" valign="middle" style="display: none;" width="17">
                                    <div id="displayfield-1748-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="x-field important price-row x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1749" style="table-layout: auto;">
                        <tbody>
                            <tr id="displayfield-1749-inputRow">
                                <td id="displayfield-1749-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                    <label id="displayfield-1749-labelEl" for="displayfield-1749-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><strong>Op. Exonerada</strong></label>
                                </td>
                                <td class="x-form-item-body " id="displayfield-1749-bodyEl" colspan="2" role="presentation">
                                    <div id="displayfield-1749-inputEl" class="x-form-display-field" aria-invalid="false"><?php echo /*$simbolo_moneda . ' ' . */number_format($op_exonerada, 2); ?></div>
                                </td>
                                <td id="displayfield-1749-sideErrorCell" valign="middle" style="display: none;" width="17">
                                    <div id="displayfield-1749-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="x-field price-row x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1750" style="table-layout: auto;">
                        <tbody>
                            <tr id="displayfield-1750-inputRow">
                                <td id="displayfield-1750-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                    <label id="displayfield-1750-labelEl" for="displayfield-1750-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><strong>IGV (18%)</strong></label>
                                </td>
                                <td class="x-form-item-body " id="displayfield-1750-bodyEl" colspan="2" role="presentation">
                                    <div id="displayfield-1750-inputEl" class="x-form-display-field" aria-invalid="false"><?php echo /*$simbolo_moneda . ' ' . */number_format($sumaigv, 2); ?></div>
                                </td>
                                <td id="displayfield-1750-sideErrorCell" valign="middle" style="display: none;" width="17">
                                    <div id="displayfield-1750-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="x-field price-row x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1750" style="table-layout: auto;">
                        <tbody>
                            <tr id="displayfield-1750-inputRow">
                                <td id="displayfield-1750-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                    <label id="displayfield-1750-labelEl" for="displayfield-1750-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><strong>ICBPER</strong></label>
                                </td>
                                <td class="x-form-item-body " id="displayfield-1750-bodyEl" colspan="2" role="presentation">
                                    <div id="displayfield-1750-inputEl" class="x-form-display-field" aria-invalid="false"><?php echo /*$simbolo_moneda . ' ' . */number_format($sumaicbper, 2); ?></div>
                                </td>
                                <td id="displayfield-1750-sideErrorCell" valign="middle" style="display: none;" width="17">
                                    <div id="displayfield-1750-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="x-field important price-total x-table-plain x-form-item x-field-default x-autocontainer-form-item" cellpadding="0" id="displayfield-1751" style="table-layout: auto;"><tbody>
                        <tr id="displayfield-1751-inputRow">
                            <td id="displayfield-1751-labelCell" style="" valign="top" halign="right" width="170" class="x-field-label-cell">
                                <label id="displayfield-1751-labelEl" for="displayfield-1751-inputEl" class="x-form-item-label x-unselectable x-form-item-label-right" style="width:150px;margin-right:20px;" unselectable="on"><h4>Total</h4> </label>
                            </td>
                            <td class="x-form-item-body " id="displayfield-1751-bodyEl" colspan="2" role="presentation">
                                <div id="displayfield-1751-inputEl" class="x-form-display-field" aria-invalid="false"><h4><?php echo /*$simbolo_moneda . ' ' . */number_format($subtotal, 2); ?></h4></div>
                            </td>
                            <td id="displayfield-1751-sideErrorCell" valign="middle" style="display: none;" width="17">
                                <div id="displayfield-1751-errorEl" class="x-form-error-msg x-form-invalid-icon" style="display:none" data-errorqtip=""></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </span>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.txt_desc').off('blur');
        $('.txt_desc').on('blur',function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
        // if(keycode == '13'){
            tmpCotizaciones_id = $(this).attr("id");
            desc = $(this).val();
             //Inicia validacion
             if (isNaN(desc)) {
                $.Notification.notify('error','bottom center','ERROR', 'DIGITAR UN DESCUENTO VALIDO')
                $(this).focus();
                return false;
            }
    //Fin validacion
    $.ajax({
        type: "POST",
        url: "../ajax/editar_desc_cotizacion.php",
        data: "tmpCotizaciones_id=" + tmpCotizaciones_id + "&desc=" + desc,
        success: function(datos) {
           $("#resultados").load("../ajax/agregarTmpcotizaciones.php");
           $.Notification.notify('success','bottom center','EXITO!', 'DESCUENTO ACTUALIZADO CORRECTAMENTE')
       }
   });
        // }
    });

        $(".employee_id").on("change", function(event) {
           tmpCotizaciones_id = $(this).attr("id");
           precio = $(this).val();
           $.ajax({
            type: "POST",
            url: "../ajax/editar_precio_cotizacion.php",
            data: "tmpCotizaciones_id=" + tmpCotizaciones_id + "&precio=" + precio,
            success: function(datos) {
             $("#resultados").load("../ajax/agregarTmpCotizaciones.php");
             $.Notification.notify('success','bottom center','EXITO!', 'PRECIO ACTUALIZADO CORRECTAMENTE')
         }
     });
       });

    });
</script>

