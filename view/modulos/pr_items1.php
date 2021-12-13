<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
session_start();

include "../modal/imgItem.php";
include "../modal/registroItem.php";
include "../modal/registroCategoria.php";
include "../modal/registroMarca.php";
include "../modal/editarItem.php";
include "../modal/especificacionesItem.php";
include "../modal/fichaItem.php";

$cadena = $_GET['almacen'];
//$id_almacen = substr($cadena, 0, -4);

$_SESSION['almacen'] = $cadena;

$sql_almacen=mysqli_query($con,"select * from almacenes where almacen_id=$cadena");
$rw_almacen=mysqli_fetch_array($sql_almacen);
$almacen_nombre=$rw_almacen['almacen_nombre'];
?>
                <div class="content">
                    <nav aria-label="breadcrumb" style="margin-top: -6px;">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/pr_items.php')" style="cursor: pointer;">Art&iacute;culos</a></li>
                        <li class="breadcrumb-item active"><a onclick="load(1)" style="cursor: pointer;"><?php echo $almacen_nombre; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado &Iacute;tems</li>
                      </ol>
                    </nav>
                    <div class="page-content container-fluid" style="margin-top: -20px;">
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white">
                                    <div class="card-body">
                                        <div id="ldng_cat"></div>
                                        <div id="resultados_ajax"></div>
                                        <div class='outer_div_cat'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script src="../js/items.js"></script>
<script>
//Muestra a4
function itemsPDF(){
    var datos=$("#datos").val();
    VentanaCentrada('../view/pdf/documentos/a4_items.php?action=ajax&datos='+datos,'Factura','','1024','768','true');
}
function itemsExcel(){
    var datos=$("#datos").val();
    window.open('../view/excel/items.php?action=ajax&datos='+datos,'_blank');
}
</script>