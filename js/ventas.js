/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Ventas | Prizma Technology ::.');
//
$(document).ready(function () {
  loadB(1);
  loadF(1);
  loadNC(1);
  loadND(1);
  loadNP(1);

  $('.daterange').daterangepicker({
    buttonClasses: ['btn', 'btn-sm'],
    applyClass: 'btn-primary',
    cancelClass: 'btn-danger',
    locale: {
      format: 'DD/MM/YYYY',
      separator: ' - ',
      applyLabel: 'Aplicar',
      cancelLabel: 'Cancelar',
      fromLabel: 'Desde',
      toLabel: 'Hasta',
      customRangeLabel: 'Personalizado',
      daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
      monthNames: [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
      ],
    },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
      'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
      'Este mes': [moment().startOf('month'), moment().endOf('month')],
      'El mes pasado': [
        moment().subtract(1, 'month').startOf('month'),
        moment().subtract(1, 'month').endOf('month'),
      ],
    },
    opens: 'right',
  });
});
//Busca los datos
function loadB(page) {
  //var range=$("#range").val();
  $('#ldng_cat_b').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarBoletas.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat_b').html(data).fadeIn('slow');
      $('#ldng_cat_b').html('');
      //console.log(data);
    },
  });
}
//Busca los datos
function loadF(page) {
  //var range=$("#range").val();
  $('#ldng_cat_f').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarFacturas.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat_f').html(data).fadeIn('slow');
      $('#ldng_cat_f').html('');
      //console.log(data);
    },
  });
}
//Busca los datos
function loadNC(page) {
  //var range=$("#range").val();
  $('#ldng_cat_nc').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarNotaCreditos.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat_nc').html(data).fadeIn('slow');
      $('#ldng_cat_nc').html('');
      //console.log(data);
    },
  });
}
//Busca los datos
function loadND(page) {
  //var range=$("#range").val();
  $('#ldng_cat_nd').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarNotaDebitos.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat_nd').html(data).fadeIn('slow');
      $('#ldng_cat_nd').html('');
      //console.log(data);
    },
  });
}
//Busca los datos
function loadNP(page) {
  //var range=$("#range").val();
  $('#ldng_cat_np').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarNotaPedidos.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat_np').html(data).fadeIn('slow');
      $('#ldng_cat_np').html('');
      //console.log(data);
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
    url: '../ajax/eliminarDocumento.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('.datos_ajax_delete').html(datos);
      $('.datos_ajax_delete').html('');
      $('.datos_ajax_delete').removeClass('ajax-loader');
      $('#eliminar').html('S&iacute;, continuar');
      $('#eliminar').attr('disabled', false);
      $('#eliminarDocumento').modal('hide');
      loadB(1);
      loadF(1);
      loadNC(1);
      loadND(1);
      loadNP(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
