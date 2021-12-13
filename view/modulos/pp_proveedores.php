<!-- Start Breadcrumbbar -->
<?php include "../modal/registroProveedor.php"; ?>
<?php include "../modal/editarProveedor.php"; ?>
<?php include "../modal/detallesProveedor.php"; ?>
<?php include "../modal/eliminarProveedor.php"; ?>
<?php include "../modal/verprodProveedor.php"; ?>

            <div class="content">
                    <nav aria-label="breadcrumb" style="margin-top: -6px;">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
                        <li class="breadcrumb-item"><a onclick="load(1)" style="cursor: pointer;">Personas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado Proveedores</li>
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
                                        <input type="hidden" id="datos" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script src="../js/proveedores.js"></script>
<script src="../js/ventanaCentrada.js"></script>
<script>
//Muestra a4
function proveedoresPDF(){
    var datos=$("#datos").val();
    VentanaCentrada('../view/pdf/documentos/a4_proveedores.php?action=ajax&datos='+datos,'Factura','','1024','768','true');
}
//
function proveedoresExcel(){
    //alert('entro');
    var datos=$("#datos").val();
    window.open('../view/excel/proveedores.php?action=ajax&datos='+datos,'_blank');
}
</script>