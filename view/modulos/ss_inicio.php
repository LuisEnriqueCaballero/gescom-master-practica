<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Verificamos si el usuario esta logueado, si no esta logueado lo redirecciona al login, si ya esta logueado se queda en el panel
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: ../login/");
  exit;
}
//Nos conectamos a la base de datos
include("../../config/db.php");
include("../../config/conexion.php");
//Inicia Control de Permisos
$user_id = $_SESSION['usuario_id'];
//Archivo de funciones PHP
require_once "../../view/funciones/funciones.php";
//
//Definimos el sexo del usuario
$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "o";
}
if ($sex==2) {
   $sexo = "a";
}
//Sesion del establecimiento
$tienda = $_SESSION['tienda'];
//
$sql_almacen = "select * from almacenes where almacen_idSucursal='$tienda' and almacen_activo='1' order by almacen_orden asc limit 0,1";
$query_almacen = mysqli_query($con,$sql_almacen);
$row_almacen = mysqli_fetch_array($query_almacen);
$almacen_id = $row_almacen['almacen_id'];
//Eventos
$sql = "SELECT * FROM events WHERE (evento_idUsuario='$user_id' OR evento_idUsuario='0') AND evento_idSucursal='$tienda'";
$usuario1 = mysqli_query($con,$sql);
//Grafico area
$periodo1 = date("Y");
$id_moneda = 115;
//Carga datos
if(isset($periodo1)){ 
    $txt_mes = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4"  => "Abril", "5"  => "Mayo", "6"  => "Junio","7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre",
    );
    $graficoAreaData = array();
    for ($inicio = 1; $inicio <= 12; $inicio++) {
        $mes          = $txt_mes[$inicio]; //Obtengo la abreviatura del mes
        $Venta        = montoVenta('facturas', $inicio, $periodo1, $id_moneda); //Obtengo el  monto de los ingresos
        $factura      = montoCompra('facturas_compras', $inicio, $periodo1, $id_moneda); //Obtengo el monto de los egresos
        $cotizaciones = montoCotizacion('facturas_cotizaciones', $inicio, $periodo1, $id_moneda); //Obtengo el monto de los egresos
        $Pedido       = montoPedido('facturas', $inicio, $periodo1, $id_moneda);
        $graficoAreaData[] = array(
          "period" => $mes,
          "up" => $Venta,
          "dl" => $factura,
          "ct" => $cotizaciones,
          "np" => $Pedido
        );
    }
    $json_graficoArea = json_encode($graficoAreaData);
}
//Grafico barras
$periodo2 = date("Y");
$id_moneda1 = 115;
//Carga datos
if(isset($periodo2)){ 
    $txt_mes = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4"  => "Abril", "5"  => "Mayo", "6"  => "Junio","7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre",
    );
    $graficoBarrasData = array();
    $mes = date('m');
    $mes1 = explode('0', $mes);
    $actual = $mes1[1];
    for ($inicio = 1; $inicio <= 12; $inicio++) {
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
//Grafico donut
$grafico_donut = "select producto_nombre, producto_vendido from productos where producto_idSucursal=$almacen_id ORDER BY producto_vendido DESC LIMIT 10";
$result_donut = mysqli_query($con, $grafico_donut);
$dataGraficoDonut = array();
while($row_donut = mysqli_fetch_array($result_donut))
{
 $dataGraficoDonut[] = array(
  'label'  => $row_donut["producto_nombre"],
  'value'  => $row_donut["producto_vendido"]
 );
}
$dataGraficoDonut = json_encode($dataGraficoDonut);
?>
                <div class="content">
                    <header class="page-header">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <div class="button-list">
                                    <div class="btn-group btn-group-toggle btn-xs" data-toggle="buttons">
                                        <label class="btn btn-secondary active btn-xs" onclick="cambiaSoles();cambiaSoles1();" style="cursor: url(../img/company/cursorH1.png), pointer;">
                                            <input type="radio" name="options" checked> SOLES (PEN)
                                        </label>
                                        <label class="btn btn-secondary btn-xs" onclick="cambiaDolares();cambiaDolares1();" style="cursor: url(../img/company/cursorH1.png), pointer;">
                                            <input type="radio" name="options"> D&Oacute;LARES (USD)
                                        </label>
                                    </div>
                                    <div id="tipoMoneda"><input type="hidden" class="form-control" autocomplete="off" id="id_moneda" name="id_moneda" value="115" readonly=""></div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!--START PAGE CONTENT -->
                    <section class="page-content container-fluid">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card bg-white">
                                    <h5 class="card-header">Comparativa Doc. Electr&oacute;nicos, Compras, Cotizaciones y N. Pedidos</h5>
                                    <div class="card-body p-10">
                                        <div id="grafComparativo"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-white">
                                    <h5 class="card-header">Top 10 &iacute;tems m&aacute;s vendidos</h5>
                                    <div class="card-body p-10">
                                        <div id="graficoDonut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white">
                                    <div class="row m-0 col-border-xl">
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/payment-method.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter" id="totalCobros_v">(S/) <?php total_cxc();?></h5>
                                                <p class="text-muted m-t-10" id="totalCobros_t">
                                                    Total Cobros
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/sales.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter" id="totalVentas_v">(S/) <?php total_ingresos();?></h5>
                                                <p class="text-muted m-t-10" id="totalVentas_t">
                                                    Total Ventas
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/items.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter"><?php total_items($almacen_id);?></h5>
                                                <p class="text-muted m-t-10">
                                                    Total &Iacute;tems
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/target.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter"><?php total_clientes();?></h5>
                                                <p class="text-muted m-t-10">
                                                    Total clientes
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white">
                                    <div class="row m-0 col-border-xl">

                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/purchasing.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter" id="totalPagos_v">(S/) <?php total_cxp();?></h5>
                                                <p class="text-muted m-t-10" id="totalPagos_t">
                                                    Total Pagos
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/shopping-cart.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter" id="totalCompras_v">(S/) <?php total_compras();?></h5>
                                                <p class="text-muted m-t-10" id="totalCompras_t">
                                                    Total Compras
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/contacts.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter"><?php total_usuarios();?></h5>
                                                <p class="text-muted m-t-10">
                                                    Total Usuarios
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-3">
                                            <div class="card-body">
                                                <div class="float-left m-r-20">
                                                    <img src="../assets/images/svg-icon/shipment.svg" style="width: 40px">
                                                </div>
                                                <h5 class="card-title m-b-5 counter"><?php total_proveedores();?></h5>
                                                <p class="text-muted m-t-10">
                                                    Total Proveedores
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bg-white">
                                    <h5 class="card-header">Comparativa Documentos Emitidos</h5>
                                    <div class="card-body p-10">
                                        <div id="grafDocumentos" style="height: 480px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-white">
                                    <h5 class="card-header">Usuarios Conectados</h5>
                                    <div class="card-body p-0">
                                        <div id="cargaConectados"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-white">
                                    <div class="card-body p-10 bg-white">
                                        <div id="calendario_inicio"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--END PAGE CONTENT -->
                </div>
<script src="../js/panel.js"></script>
<!-- Grafico de area -->
<script>
    //Data inicial
    var areaData = <?php echo $json_graficoArea; ?>;
    //Carga grafico
    var graficoArea = Morris.Line({
        element: 'grafComparativo',
        data: areaData,
        xkey: 'period',
        ykeys: ['up', 'dl', 'ct', 'np'],
        labels: ['Doc. Electronicos', 'Compras', 'Cotizaciones', 'N. Pedidos'],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        gridTextColor: '#8f9ea6',
        gridTextSize: '11px',
        //lineColors: ['green', 'red', 'blue', 'yellow'],
        lineWidth: 2,
        parseTime: false,
        resize:true,
        hideHover: 'auto'
    });
</script>
<!-- Grafico de barras -->
<script>
    //Data inicial
    var barrasData = <?php echo $json_graficoBarras; ?>;
    //Carga grafico
    var graficoBarras = Morris.Bar({
        element: 'grafDocumentos',
        data: barrasData,
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        labels: ['Boleta', 'Factura', 'N. Credito', 'N. Debito', 'C. Baja', 'G. Remision', 'N. Pedido'],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        gridTextColor: '#8f9ea6',
        gridTextSize: '11px',
        //barColors: ['blue', 'green', 'orange', 'yellow', 'red', 'skyblue', 'grey'],
        resize:true,
        hideHover: 'auto'
    });
</script>
<!-- Grafico donut-->
<script>
    //Data inicial
    var donutData = <?php echo $dataGraficoDonut; ?>;
    //console.log(donutData);
    //Carga grafico
    var graficoDonut = Morris.Donut({
        element: 'graficoDonut',
        data: donutData,
        resize:true
    });
</script>
<!-- Funciones adicionales -->
<script>
    //Cambiamos los datos a soles
    function cambiaSoles() {
        $("#loader").fadeIn('slow');
        $.ajax({
            url: "../ajax/grafico/comparativo.php",
            type: "POST",
            dataType: "json",
            beforeSend: function(objeto) {
                //$('#load_contenido').html('<img src="../assets/images/svg-icon/loading.svg" width="50"><p>');
                //$('#load_contenido').addClass('ajax-loader-contenido');
            },
            success: function (data) {
                $("#totalCobros_t").html('<p class="text-muted m-t-10" id="totalCobros_t">Total Cobros</p>');
                $("#totalCobros_v").html('<h5 class="card-title m-b-5 counter" id="totalCobros_v">(S/) <?php total_cxc();?></h5>');
                $("#totalVentas_t").html('<p class="text-muted m-t-10" id="totalVentas_t">Total Ventas</p>');
                $("#totalVentas_v").html('<h5 class="card-title m-b-5 counter" id="totalVentas_v">(S/) <?php total_ingresos();?></h5>');
                $("#totalPagos_t").html('<p class="text-muted m-t-10" id="totalPagos_t">Total Pagos</p>');
                $("#totalPagos_v").html('<h5 class="card-title m-b-5 counter" id="totalPagos_v">(S/) <?php total_cxp();?></h5>');
                $("#totalCompras_t").html('<p class="text-muted m-t-10" id="totalCompras_t">Total Compras</p>');
                $("#totalCompras_v").html('<h5 class="card-title m-b-5 counter" id="totalCompras_v">(S/) <?php total_compras();?></h5>');
                graficoArea.setData(data);
                //$('#load_contenido').html('');
                //$('#load_contenido').removeClass('ajax-loader-contenido');
            },
        });
    }
    //
    function cambiaSoles1() {

        $.ajax({
            url: "../ajax/grafico/comparativo3.php",
            type: "POST",
            dataType: "json",
            success: function (data) {
                graficoBarras.setData(data);
            },
        });
    }
    //Cambiamos los datos a dolares
    function cambiaDolares() {
        $("#loader").fadeIn('slow');
        $.ajax({
            url: "../ajax/grafico/comparativo1.php",
            type: "POST",
            dataType: "json",
            beforeSend: function(objeto) {
                //$('#load_contenido').html('<img src="../assets/images/svg-icon/loading.svg" width="50"><p>');
                //$('#load_contenido').addClass('ajax-loader-contenido');
            },
            success: function (data) {
                $("#totalCobros_t").html('<p class="text-muted m-t-10" id="totalCobros_t">Total Cobros</p>');
                $("#totalCobros_v").html('<h5 class="card-title m-b-5 counter" id="totalCobros_v">($) <?php total_cxc1();?></h5>');
                $("#totalVentas_t").html('<p class="text-muted m-t-10" id="totalVentas_t">Total Ventas</p>');
                $("#totalVentas_v").html('<h5 class="card-title m-b-5 counter" id="totalVentas_v">($) <?php total_ingresos1();?></h5>');
                $("#totalPagos_t").html('<p class="text-muted m-t-10" id="totalPagos_t">Total Pagos</p>');
                $("#totalPagos_v").html('<h5 class="card-title m-b-5 counter" id="totalPagos_v">($) <?php total_cxp1();?></h5>');
                $("#totalCompras_t").html('<p class="text-muted m-t-10" id="totalCompras_t">Total Compras</p>');
                $("#totalCompras_v").html('<h5 class="card-title m-b-5 counter" id="totalCompras_v">($) <?php total_compras1();?></h5>');
                graficoArea.setData(data);
                //$('#load_contenido').html('');
                //$('#load_contenido').removeClass('ajax-loader-contenido');
            },
        });
    }
    //
    function cambiaDolares1() {

        $.ajax({
            url: "../ajax/grafico/comparativo2.php",
            type: "POST",
            dataType: "json",
            success: function (data) {
                graficoBarras.setData(data);
            },
        });
    }
</script>
<!-- Calendario -->
<script>
    $('#calendario_inicio').fullCalendar({
        eventLimit: true,
        selectable: true,
        selectHelper: true,
        eventRender: function(event, element) {
            element.bind('click', function() {
                $('#ModalDetalle #title').text(event.title);
                $('#ModalDetalle #description').text(event.description);
                $('#ModalDetalle #usuario').text(event.usuario);
                $('#ModalDetalle #start').text(moment(event.start).format('DD/MM/YYYY hh:mm A'));
                $('#ModalDetalle #end').text(moment(event.end).format('DD/MM/YYYY hh:mm A'));
                $('#ModalDetalle').modal('show');
            });
        },
        events: [
        <?php
          while ($row6=mysqli_fetch_array($usuario1)){

            $start = explode(" ", $row6['evento_inicio']);
            $end = explode(" ", $row6['evento_fin']);
            if($start[1] == '00:00:00'){
              $start = $start[0];
            }else{
              $start = $row6['evento_inicio'];
            }
            if($end[1] == '00:00:00'){
              $end = $end[0];
            }else{
              $end = $row6['evento_fin'];
            }

            $tipo = $row6['evento_idUsuario'];

            if ($tipo == 0) {
                $seleccion = "Publico";
            }
            if ($tipo != 0) {
                $seleccion = "Personal";
            }
        ?>
            {
                id: '<?php echo $row6['evento_id']; ?>',
                title: '<?php echo $row6['evento_titulo']; ?>',
                description: '<?php echo $row6['evento_descripcion']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '<?php echo $row6['evento_color']; ?>',
                usuario: '<?php echo $seleccion; ?>',
            },
        <?php } ?>
        ]
    });
</script>
<script>
    setInterval(
        function(){
          $('#cargaConectados').load('../ajax/cargaConectados.php');
        },1000
    );
</script>