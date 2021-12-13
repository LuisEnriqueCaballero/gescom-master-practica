<!-- Start Breadcrumbbar -->  
<?php
session_start();
include "../modal/enviarWhatsAppCot.php";
include "../modal/enviarCorreoCot.php";
include "../modal/eliminarCot.php";
?>
            <div class="content">
                <nav aria-label="breadcrumb" style="margin-top: -6px;">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
                        <li class="breadcrumb-item"><a onclick="load(1)" style="cursor: pointer;">Cotizaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado Cotizaciones</li>
                      </ol>
                    </nav>
                    <div class="page-content container-fluid" style="margin-top: -20px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-white">
                                <div class="card-body">
                                    
                                <div class="input-group">
                                    <input type="text" class="form-control daterange pull-right" value="<?php echo "01" . date('/m/Y') . ' - ' . date('d/m/Y'); ?>" id="range" readonly>
                                    <div class="input-group-append">
                                        <div class="btn btn-primary" type="button" onclick='load(1);'><i class='fa fa-search' style="color: #fff;"></i></div>
                                    </div>
                                </div>
                                    <div id="ldng_cat"></div>
                                    <div id="resultados_ajax"></div>
                                    <div class='outer_div_cat'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="../js/cotizaciones.js"></script>
<script src="../js/ventanaCentrada.js"></script>
<script>
$(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
  $(function() {
    load(1);

//Date range picker
$('.daterange').daterangepicker({
  buttonClasses: ['btn', 'btn-sm'],
  applyClass: 'btn-primary',
  cancelClass: 'btn-danger',
  locale: {
    format: "DD/MM/YYYY",
    separator: " - ",
    applyLabel: "Aplicar",
    cancelLabel: "Cancelar",
    fromLabel: "Desde",
    toLabel: "Hasta",
    customRangeLabel: "Personalizado",
    daysOfWeek: [
    "Do",
    "Lu",
    "Ma",
    "Mi",
    "Ju",
    "Vi",
    "Sa"
    ],
    monthNames: [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
    ],
  },
  ranges: {
       'Hoy': [moment(), moment()],
       'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
       'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
       'Este mes': [moment().startOf('month'), moment().endOf('month')],
       'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
  opens: "right"

});
});
</script>
<script>   
function imprimir_facturas2(id_factura){
    VentanaCentrada('../view/pdf/documentos/a4_cot.php?comp='+id_factura,'Factura','','1024','768','true');
}
function imprimir_facturas3(id_factura){
    VentanaCentrada('../view/pdf/documentos/ticket_cot.php?comp='+id_factura,'Factura','','1024','768','true');
}
</script>