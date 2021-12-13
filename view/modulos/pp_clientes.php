<!-- Start Breadcrumbbar -->
<?php session_start(); ?>
<?php include "../modal/registroCliente.php"; ?>
<?php include "../modal/editarCliente.php"; ?>
<?php include "../modal/detallesCliente.php"; ?>
<?php include "../modal/eliminarCliente.php"; ?>

            <div class="content">
                    <nav aria-label="breadcrumb" style="margin-top: -6px;">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
                        <li class="breadcrumb-item"><a onclick="load(1)" style="cursor: pointer;">Personas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado Clientes</li>
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
<script src="../js/clientes.js"></script>
<script src="../js/ventanaCentrada.js"></script>
<script>
//Muestra a4
function clientesPDF(){
    var datos=$("#datos").val();
    VentanaCentrada('../view/pdf/documentos/a4_clientes.php?action=ajax&datos='+datos,'Factura','','1024','768','true');
}
//
function clientesExcel(){
    var datos=$("#datos").val();
    window.open('../view/excel/clientes.php?action=ajax&datos='+datos,'_blank');
}
</script>