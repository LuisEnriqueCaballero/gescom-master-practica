/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Cotizaciones | Prizma Technology ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  //var range=$("#range").val();
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarCotizaciones.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
      console.log(data);
    },
  });
}
//Obtiene los datos en el modal
$('#enviarWhatsApp').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id');
  var telefono = button.data('telefono');
  var nombre = button.data('nombre');
  var modal = $(this);
  modal.find('#id_factura').val(id);
  modal.find('#cliente_telefono').val(telefono);
  modal.find('#titulo').text(nombre);
});
//
$('#enviarCorreo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id');
  var correo = button.data('correo');
  var nombre = button.data('nombre');
  var modal = $(this);
  modal.find('#id_factura').val(id);
  modal.find('#cliente_correo').val(correo);
  modal.find('#titulo').text(nombre);
});
//Elimina
$('#eliminarDocumento').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id'); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find('#id_factura').val(id);
});
$('#eliminarDatos').submit(function (event) {
  $('#eliminar').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Anulando...'
  );
  $('#eliminar').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/eliminarCotizacion.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('.datos_ajax_delete').html(datos);
      $('.datos_ajax_delete').html('');
      $('.datos_ajax_delete').removeClass('ajax-loader');
      $('#eliminar').html('S&iacute;, continuar');
      $('#eliminar').attr('disabled', false);
      $('#eliminarDocumento').modal('hide');
      load(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
//Marcamos el menu lateral
$('#inicio').removeClass('active');
$('#notas').removeClass('active');
$('#anuncios').removeClass('active');
$('#calendario').removeClass('active');
//Modulo archivos
$('#archivos').removeClass('active');
$('#carpetas').removeClass('active');
$('#misArchivos').removeClass('active');
//Modulo personas
$('#personas').removeClass('active');
$('#clientes').removeClass('active');
$('#proveedores').removeClass('active');
$('#colaboradores').removeClass('active');
//Modulo articulos
$('#articulos').removeClass('active');
$('#marcas').removeClass('active');
$('#categorias').removeClass('active');
$('#segmentos').removeClass('active');
$('#familias').removeClass('active');
$('#clases').removeClass('active');
$('#undMedida').removeClass('active');
$('#items').removeClass('active');
$('#kardex').removeClass('active');
$('#ajustarInventario').removeClass('active');
//Modulo ventas
$('#ventas').removeClass('active');
$('#nuevaVenta').removeClass('active');
$('#nuevaFactura').removeClass('active');
$('#historialVentas').removeClass('active');
$('#historialPagos').removeClass('active');
//Modulo cotizaciones
$('#cotizaciones').addClass('active');
$('#nuevaCotizacion').removeClass('active');
$('#historialCotizaciones').addClass('active');
//Modulo egresos
$('#egresos').removeClass('active');
$('#nuevaCompra').removeClass('active');
$('#historialCompras').removeClass('active');
$('#categoriaGastos').removeClass('active');
$('#historialGastos').removeClass('active');
//Modulo facturacion electronica
$('#facturacionElectronica').removeClass('active');
$('#notaDebito').removeClass('active');
$('#nuevaNotaDebitoFactura').removeClass('active');
$('#nuevaNotaDebitoBoleta').removeClass('active');
$('#historialNotaDebitos').removeClass('active');
$('#notaCredito').removeClass('active');
$('#nuevaNotaCreditoFactura').removeClass('active');
$('#nuevaNotaCreditoBoleta').removeClass('active');
$('#historialNotaCreditos').removeClass('active');
$('#resumenDiario').removeClass('active');
$('#documentosElectronicos').removeClass('active');
$('#comunicacionBaja').removeClass('active');
$('#guiaRemision').removeClass('active');
//Modulo contabilidad
$('#contabilidad').removeClass('active');
$('#cuentasBancarias').removeClass('active');
$('#registroCompras').removeClass('active');
$('#registroVentas').removeClass('active');
$('#tipoAfectacion').removeClass('active');
$('#tipoMonedas').removeClass('active');
$('#tipoClientes').removeClass('active');
$('#tipoCambio').removeClass('active');
$('#igv').removeClass('active');
//Modulo creditos
$('#creditos').removeClass('active');
$('#cuentasPagar').removeClass('active');
$('#cuentasCobrar').removeClass('active');
//Modulo rrhh
$('#rrhh').removeClass('active');
$('#variablesDescansos').removeClass('active');
$('#consultaAsistencia').removeClass('active');
$('#listaAsistencia').removeClass('active');
$('#listaDescanso').removeClass('active');
$('#vacaciones').removeClass('active');
$('#contratos').removeClass('active');
$('#planilla').removeClass('active');
//Modulo crm
$('#crm').removeClass('active');
$('#tareas').removeClass('active');
$('#proyectos').removeClass('active');
$('#callCenter').removeClass('active');
$('#propuestas').removeClass('active');
$('#presupuestos').removeClass('active');
$('#historialTickets').removeClass('active');
$('#clientesPotenciales').removeClass('active');
//Modulo ajustes
$('#ajustes').removeClass('active');
$('#datosEmpresa').removeClass('active');
$('#seriesCorrelativos').removeClass('active');
$('#certificadoDigital').removeClass('active');
$('#cuentasUsuarios').removeClass('active');
$('#accesosUsuarios').removeClass('active');
$('#logsUsuarios').removeClass('active');
//Modulo reportes
$('#reportes').removeClass('active');
$('#gastos').removeClass('active');
$('#reporteVentas').removeClass('active');
$('#ventasUsuario').removeClass('active');
$('#ventasCliente').removeClass('active');
$('#ventasResumen').removeClass('active');
$('#reporteCompras').removeClass('active');
$('#comprasUsuario').removeClass('active');
$('#comprasProveedor').removeClass('active');
$('#comprasResumen').removeClass('active');
$('#consolidado').removeClass('active');
$('#balanceProductos').removeClass('active');
$('#utilidadesProductos').removeClass('active');
$('#gastosVSingresos').removeClass('active');
