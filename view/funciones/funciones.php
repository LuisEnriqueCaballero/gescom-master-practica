<?php
//session_start();
function get_row($table, $row, $id, $equal)
{
    global $con;
    $query = mysqli_query($con, "select $row from $table where $id='$equal'");
    $rw    = mysqli_fetch_array($query);
    $value = $rw[$row];
    return $value;
}

function condicion($tipo)
{
    if ($tipo == 1) {
        return 'Efectivo';
    } elseif ($tipo == 2) {
        return 'Cheque';
    } elseif ($tipo == 3) {
        return 'Transferencia bancaria';
    } elseif ($tipo == 4) {
        return 'Crédito';
    }
}
/*--------------------------------------------------------------*/
/* MODIFICAR LOS DATOS DEL GRAFICO
/*--------------------------------------------------------------*/
function montoVenta($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where factura_tipo<=2 and factura_sucursal=$tienda and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoCompra($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    //$query = mysqli_query($con, "select count(compras_total) as monto from $table where compras_tipo<=2 and compras_sucursal=$tienda and compras_moneda=$id_moneda and compras_fecha between '$fecha_inicial' and '$fecha_final'");
    //$row   = mysqli_fetch_array($query);
    $monto = 100.00; //floatval($row['monto']);
    return $monto;
}

function montoCotizacion($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(cotizacion_ventaTotal) as monto from $table where cotizacion_tipo=9 and cotizacion_sucursal=$tienda and cotizacion_moneda=$id_moneda and cotizacion_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoPedido($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query1 = mysqli_query($con, "select count(factura_ventaTotal) as monto1 from $table where factura_tipo=5 and factura_sucursal=$tienda and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row1   = mysqli_fetch_array($query1);
    $monto1 = floatval($row1['monto1']);
    return $monto1;
}

/**/

function montoBoleta($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where factura_tipo=2 and factura_sucursal=$tienda and factura_activo=1 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoFactura($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where factura_tipo=1 and factura_sucursal=$tienda and factura_activo=1 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoNC($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where (factura_tipo=3 or factura_tipo=6) and factura_sucursal=$tienda and factura_activo=1 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoND($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where (factura_tipo=4 or factura_tipo=7) and factura_sucursal=$tienda and factura_activo=1 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoBaja($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where (factura_tipo=1 or factura_tipo=2) and factura_sucursal=$tienda and factura_activo=0 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function montoGuia($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    //$query = mysqli_query($con, "select count(id_doc) as monto from $table where tienda=$tienda and guia_moneda=$id_moneda and fecha between '$fecha_inicial' and '$fecha_final'");
    //$row   = mysqli_fetch_array($query);
    $monto = 80.00; //floatval($row['monto']);
    return $monto;
}

function montoNPedido($table, $mes, $periodo, $id_moneda)
{
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";
    $tienda = $_SESSION['tienda'];

    $query = mysqli_query($con, "select count(factura_ventaTotal) as monto from $table where factura_tipo=5 and factura_sucursal=$tienda and factura_activo=1 and factura_moneda=$id_moneda and factura_fecha between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}

function stock($stock)
{
    if ($stock == 0) {
        return '<span class="badge badge-danger">' . $stock . '</span>';
    } else if ($stock <= 3) {
        return '<span class="badge badge-warning">' . $stock . '</span>';
    } else {
        return '<span class="badge badge-primary">' . $stock . '</span>';
    }
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Clientes
/*--------------------------------------------------------------*/
function total_clientes()
{
    $tienda = $_SESSION['tienda'];
    global $con;
    $orderSql       = "SELECT * FROM clientes where (cliente_sucursal=$tienda or cliente_sucursal=0)";
    $orderQuery     = $con->query($orderSql);
    $countPacientes = $orderQuery->num_rows;

    echo '' . $countPacientes . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Proveedores
/*--------------------------------------------------------------*/
function total_proveedores()
{
    $tienda = $_SESSION['tienda'];
    global $con;
    $orderSql       = "SELECT * FROM proveedores where (proveedor_sucursal=$tienda or proveedor_sucursal=0)";
    $orderQuery     = $con->query($orderSql);
    $countProveedores = $orderQuery->num_rows;

    echo '' . $countProveedores . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Usuarios
/*--------------------------------------------------------------*/
function total_usuarios()
{
    $tienda = $_SESSION['tienda'];
    global $con;
    $orderSql       = "SELECT * FROM usuarios, colaboradores where usuarios.usuario_idColaborador=colaboradores.colaborador_id and colaboradores.colaborador_sucursal=$tienda";
    $orderQuery     = $con->query($orderSql);
    $countProveedores = $orderQuery->num_rows;

    echo '' . $countProveedores . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de items
/*--------------------------------------------------------------*/
function total_items($almacen_id)
{
    $tienda = $_SESSION['tienda'];
    global $con;
    $orderSql       = "SELECT * FROM productos where producto_idSucursal='$almacen_id'";
    $orderQuery     = $con->query($orderSql);
    $countProveedores = $orderQuery->num_rows;

    echo '' . $countProveedores . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Creditos
/*--------------------------------------------------------------*/
function total_creditos()
{
    $id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas_ventas where date(fecha_factura) = '$fecha_actual' and estado_factura=2";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['monto_factura'];
    }

    echo '' . $id_moneda . '' . number_format($totalRevenue, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Abonos a proveedores
/*--------------------------------------------------------------*/
function total_cxp()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    //---------------------------------------------------------------------------------------
    $abonoSql    = "SELECT * FROM creditos_abonos_prov where date(fecha_abono) = '$fecha_actual' and abono_moneda=115 and id_sucursal=$tienda";
    //$abonoQuery  = $con->query($abonoSql);
    $total_abono = 0;
    // while ($abonoResult = $abonoQuery->fetch_assoc()) {
    //     $total_abono += $abonoResult['abono'];
    // }

    echo number_format($total_abono, 2) . '';
}

function total_cxp1()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    //---------------------------------------------------------------------------------------
    $abonoSql    = "SELECT * FROM creditos_abonos_prov where date(fecha_abono) = '$fecha_actual' and abono_moneda=151 and id_sucursal=$tienda";
    $abonoQuery  = $con->query($abonoSql);
    $total_abono = 0;
    while ($abonoResult = $abonoQuery->fetch_assoc()) {
        $total_abono += $abonoResult['abono'];
    }

    echo number_format($total_abono, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Abonos a proveedores
/*--------------------------------------------------------------*/
function total_cxc()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    //---------------------------------------------------------------------------------------
    $abonoSql    = "SELECT * FROM creditos_abonos where date(fecha_abono) = '$fecha_actual' and abono_moneda=115 and id_sucursal=$tienda";
    //$abonoQuery  = $con->query($abonoSql);
    $total_abono = 0;
    // while ($abonoResult = $abonoQuery->fetch_assoc()) {
    //     $total_abono += $abonoResult['abono'];
    // }

    echo number_format($total_abono, 2) . '';
}

function total_cxc1()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    //---------------------------------------------------------------------------------------
    $abonoSql    = "SELECT * FROM creditos_abonos where date(fecha_abono) = '$fecha_actual' and abono_moneda=151 and id_sucursal=$tienda";
    $abonoQuery  = $con->query($abonoSql);
    $total_abono = 0;
    while ($abonoResult = $abonoQuery->fetch_assoc()) {
        $total_abono += $abonoResult['abono'];
    }

    echo number_format($total_abono, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Ingresos
/*--------------------------------------------------------------*/
function total_ingresos()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas where date(factura_fecha) = '$fecha_actual' and factura_moneda=115 and (factura_tipo='1' or factura_tipo='2' or factura_tipo='5') and factura_sucursal=$tienda";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['factura_ventaTotal'];
    }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}

function total_ingresos1()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas where date(factura_fecha) = '$fecha_actual' and factura_moneda=151 and (factura_tipo='1' or factura_tipo='2' or factura_tipo='5') and factura_sucursal=$tienda";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['factura_ventaTotal'];
    }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}

function total_compras()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas_compras where date(compras_fecha) = '$fecha_actual' and compras_moneda=115 and compras_sucursal=$tienda";
    //$orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    // while ($orderResult = $orderQuery->fetch_assoc()) {
    //     $totalRevenue += $orderResult['compras_total'];
    // }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}

function total_compras1()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $tienda = $_SESSION['tienda'];
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas_compras where date(compras_fecha) = '$fecha_actual' and compras_moneda=151 and compras_sucursal=$tienda";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['compras_total'];
    }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}

function total_aceptados()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_inicial = date('Y-m-01');
    $fecha_final = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas where factura_fecha between '$fecha_inicial' and '$fecha_final'";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue   += $orderResult['factura_ventaTotal'];
        $total          = $orderResult['factura_ventaTotal'];
        $factura_aceptado = $orderResult['factura_aceptado'];

        if ($factura_aceptado == 'Aceptado') {
            $totalRevenue = $total;
        }
        if ($factura_aceptado == 'Rechazado') {
            $totalRevenue = $total;
        }
        if ($factura_aceptado == 'Pendiente') {
            $totalRevenue = $total;
        }
    }

    echo /*'' . $id_moneda . '' . */($totalRevenue*100)/$total . '';
}

function total_rechazados()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_inicial = date('Y-m-01');
    $fecha_final = date('Y-m-d');
    global $con;
    $orderSql     = "SELECT * FROM facturas where factura_aceptado='Rechazado' and factura_fecha between '$fecha_inicial' and '$fecha_final'";
    $orderQuery   = $con->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['factura_ventaTotal'];
        $total = $orderResult['factura_ventaTotal'];
    }

    echo /*'' . $id_moneda . '' . */number_format(($totalRevenue*100)/$total, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Egresos
/*--------------------------------------------------------------*/
function total_egresos()
{
    $id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    global $con;
    $orderSql    = "SELECT * FROM facturas_compras where date(fecha_factura) = '$fecha_actual'";
    $orderQuery  = $con->query($orderSql);
    $totalEgreso = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalEgreso += $orderResult['monto_factura'];
    }

    echo '' . $id_moneda . '' . number_format($totalEgreso, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Inventario Bajo
/*--------------------------------------------------------------*/
function poner_inventario()
{
    global $con;
    $lowStockSql   = "SELECT * FROM productos WHERE stock_producto <= 3 AND estado_producto = 1";
    $lowStockQuery = $con->query($lowStockSql);
    $countLowStock=$lowStockQuery->num_rows;

    echo '' . $countLowStock . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener las Ultimas Ventas
/*--------------------------------------------------------------*/
function latest_order()
{
    global $con;
    //$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);

    $sql = mysqli_query($con, "select * from facturas where factura_idCliente >0 order by  factura_id desc limit 0,5");
    while ($rw = mysqli_fetch_array($sql)) {
        $id_factura     = $rw['factura_id'];
        $numero_factura = $rw['factura_correlativo'];
        $folio_factura = $rw['factura_folio'];

        $supplier_id       = $rw['factura_idCliente'];
        $sql_s             = mysqli_query($con, "select cliente_nombre from clientes where cliente_id='" . $supplier_id . "'");
        $rw_s              = mysqli_fetch_array($sql_s);
        $supplier_name     = $rw_s['cliente_nombre'];
        $date_added        = $rw['factura_fecha'];
        list($date, $hora) = explode(" ", $date_added);
        list($Y, $m, $d)   = explode("-", $date);
        $fecha             = $d . "-" . $m . "-" . $Y;
        $total             = number_format($rw['factura_ventaTotal'], 2);
        ?>
        <tr>
            <td><img src="../img/client/client.png" class="img-fluid" width="35"></td>
            <td><a href="editar_venta.php?id_factura=<?php echo $id_factura; ?>" data-toggle="tooltip" title="Ver Factura" style="cursor: pointer;"><label class='badge badge-primary' style="cursor: pointer;"><?php echo $folio_factura.'-'.$numero_factura; ?></label></a></td>
            <td><?php echo $fecha; ?></td>
            <td class='text-left'><b><?php echo /*$id_moneda . '' . */$total; ?></b></td>
        </tr>
        <?php

    }
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Ventas del Vendedor
/*--------------------------------------------------------------*/
function venta_users()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    $users        = intval($_SESSION['usuario_id']);
    global $con;
    $orderSql   = "SELECT * FROM facturas where factura_idUsuario = '$users' and date(factura_fecha) = '$fecha_actual' and factura_moneda=115";
    $orderQuery = $con->query($orderSql);
    $countOrder = $orderQuery->num_rows;

    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['factura_ventaTotal'];
    }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}

function venta_users1()
{
    //$id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    $users        = intval($_SESSION['usuario_id']);
    global $con;
    $orderSql   = "SELECT * FROM facturas where factura_idUsuario = '$users' and date(factura_fecha) = '$fecha_actual' and factura_moneda=151";
    $orderQuery = $con->query($orderSql);
    $countOrder = $orderQuery->num_rows;

    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['factura_ventaTotal'];
    }

    echo /*'' . $id_moneda . '' . */number_format($totalRevenue, 2) . '';
}
/*--------------------------------------------------------------*/
/* Calculo del Descuento
/*--------------------------------------------------------------*/
function rebajas($base, $dto = 0)
{
    $ahorro = ($base * $dto) / 100;
    $final  = $base - $ahorro;
    return $final;
}
/*--------------------------------------------------------------*/
/* Control de Stock
/*--------------------------------------------------------------*/
function guardar_historial($id_producto, $user_id, $fecha, $nota, $reference, $quantity, $tipo)
{
    global $con;
    $sql = "INSERT INTO historial_productos (id_historial, id_producto, id_users, fecha_historial, nota_historial, referencia_historial, cantidad_historial, tipo_historial)
  VALUES (NULL, '$id_producto', '$user_id', '$fecha', '$nota', '$reference', '$quantity','$tipo');";
    $query = mysqli_query($con, $sql);

}
function agregar_stock($id_producto, $quantity)
{
    global $con;
    $update = mysqli_query($con, "update productos set producto_stock=producto_stock+'$quantity' where producto_id='$id_producto'");
    if ($update) {
        return 1;
    } else {
        return 0;
    }

}
function eliminar_stock($id_producto, $quantity)
{
    global $con;
    $update = mysqli_query($con, "update productos set producto_stock=producto_stock-'$quantity' where producto_id='$id_producto'");
    if ($update) {
        return 1;
    } else {
        return 0;
    }

}
/*--------------------------------------------------------------*/
/* Control de KARDEX
/*--------------------------------------------------------------*/
function guardar_salidas($fecha, $id_producto, $cant_salida, $costo_salida, $total_salida, $cant_saldo, $costo_saldo, $total_saldo, $fecha_added, $users, $tipo)
{
    global $con;
    $sql = "INSERT INTO kardex (kardex_fecha, kardex_idProducto, kardex_cantidadSalida, kardex_costoSalida, kardex_totalSalida, kardex_cantidadSaldo, kardex_costoSaldo, kardex_totalSaldo, kardex_registro, kardex_idUsuario, kardex_tipoMovimiento)
  VALUES ('$fecha','$id_producto','$cant_salida','$costo_salida','$total_salida', '$cant_saldo','$costo_saldo','$total_saldo','$fecha_added','$users','$tipo');";
    $query = mysqli_query($con, $sql);

}
function guardar_entradas($fecha, $id_producto, $cant_entrada, $costo_entrada, $total_entrada, $cant_saldo, $costo_promedio, $total_saldo, $fecha_added, $users, $tipo)
{
    global $con;
    $sql = "INSERT INTO kardex (kardex_fecha, kardex_idProducto, kardex_cantidadEntrada, kardex_costoEntrada, kardex_totalEntrada, kardex_cantidadSaldo, kardex_costoSaldo, kardex_totalSaldo, kardex_registro, kardex_idUsuario, kardex_tipoMovimiento)
  VALUES ('$fecha','$id_producto','$cant_entrada','$costo_entrada','$total_entrada', '$cant_saldo','$costo_promedio','$total_saldo','$fecha_added','$users','$tipo');";
    $query = mysqli_query($con, $sql);

}
function formato($valor)
{
    return number_format($valor, 2);
    //return number_format($valor, 2, '.', '.');
}
function iva($sin_iva)
{
    $iva     = get_row('perfil', 'impuesto', 'id_perfil', 1);
    $con_iva = $sin_iva + ($iva * ($sin_iva / 100));
    $con_iva = round($con_iva, 2) - $sin_iva;
    return $con_iva;
}
function generar_clave($longitud){ 
   $cadena="[^A-Z0-9]"; 
   return substr(preg_replace($cadena, "", sha1(md5(rand()))) . 
   preg_replace($cadena, "", sha1(md5(rand()))) . 
   preg_replace($cadena, "", sha1(md5(rand()))), 
   0, $longitud); 
}