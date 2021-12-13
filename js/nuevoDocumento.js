/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
	Mail: info@rilaros.com
	---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Nuevo Documento | Miracles ::.');
//
$(document).ready(function () {
  $('#resultados3').load('../ajax/cargaRecibido.php');
  $('#resultados').load('../ajax/agregarTmp.php');
  $('#cod_resultado').load('../ajax/incrementaCodProducto.php');
  load(1);

  $(function () {
    $('#cliente_nombre1').autocomplete({
      source: '../ajax/autocomplete/clientes.php',
      minLength: 2,
      select: function (event, ui) {
        event.preventDefault();
        $('#id_cliente').val(ui.item.id_cliente);
        $('#cliente_nombre1').val(ui.item.cliente_nombre);
        $('#cliente_documento').val(ui.item.cliente_documento);
        $('#cliente_telefono').val(ui.item.cliente_telefono);
        $('#cliente_direccion').val(ui.item.cliente_direccion);
      },
    });
  });

  $('#cliente_nombre1').on('keydown', function (event) {
    if (
      event.keyCode == $.ui.keyCode.LEFT ||
      event.keyCode == $.ui.keyCode.RIGHT ||
      event.keyCode == $.ui.keyCode.UP ||
      event.keyCode == $.ui.keyCode.DOWN ||
      event.keyCode == $.ui.keyCode.DELETE ||
      event.keyCode == $.ui.keyCode.BACKSPACE
    ) {
      $('#id_cliente').val('');
      $('#cliente_documento').val('');
      $('#cliente_telefono').val('');
      $('#cliente_direccion').val('');
    }
    if (event.keyCode == $.ui.keyCode.DELETE) {
      $('#cliente_nombre1').val('');
      $('#id_cliente').val('');
      $('#cliente_telefono').val('');
      $('#cliente_direccion').val('');
      $('#cliente_documento').val('');
    }
  });
});
//Buscamos el listado de productos
function load(page) {
  var q = $('#q').val();
  var tc = $('#tipoCambio').val();
  //var id_marca = $("#id_marca").val();
  var valorCambio = $('#valorCambio').val();
  //var id_categoria = $("#id_categoria").val();
  $('#loader').fadeIn('slow');
  $.ajax({
    url:
      '../ajax/productosVenta.php?action=ajax&page=' +
      page +
      '&q=' +
      q +
      '&tc=' +
      tc +
      '&valorCambio=' +
      valorCambio,
    beforeSend: function (objeto) {
      //$('#load_contenido').html('<img src="../assets/images/svg-icon/loading.svg" width="50">');
      //$('#load_contenido').addClass('ajax-loader-contenido');
    },
    success: function (data) {
      $('.outer_div').html(data).fadeIn('slow');
      //$('#load_contenido').html('');
      //$('#load_contenido').removeClass('ajax-loader-contenido');
    },
  });
}
//Agregamos al detalle
function agregar(id) {
  var precio_venta = document.getElementById('precio_venta_' + id).value;
  var cantidad = document.getElementById('cantidad_' + id).value;
  //Inicia validacion
  if (isNaN(cantidad)) {
    toastr.error('Por favor ingresa un valor v&aacute;lido', 'Oopss!');
    document.getElementById('cantidad_' + id).focus();
    return false;
  }
  if (isNaN(precio_venta)) {
    toastr.error('Por favor ingresa un valor v&aacute;lido', 'Oopss!');
    document.getElementById('precio_venta_' + id).focus();
    return false;
  }
  //Fin validacion
  $.ajax({
    type: 'POST',
    url: '../ajax/agregarTmpModalVenta.php',
    data:
      'id=' +
      id +
      '&precio_venta=' +
      precio_venta +
      '&cantidad=' +
      cantidad +
      '&operacion=' +
      2,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados').html(datos);
      toastr.success('&Iacute;tem agregado', 'Bien hecho!');
    },
  });
}
//Formulario de codigo de barras
$('#barcode_form').submit(function (event) {
  var id = $('#barcode').val();
  var cantidad = $('#barcode_qty').val();
  var id_sucursal = 1;
  //Inicia validacion
  if (isNaN(cantidad)) {
    toastr.error('Por favor ingresa un valor v&aacute;lido', 'Oopss!');
    $('#barcode_qty').focus();
    return false;
  }
  //Fin validacion
  parametros = {
    operacion: 1,
    id: id,
    id_sucursal: id_sucursal,
    cantidad: cantidad,
  };
  $.ajax({
    type: 'POST',
    url: '../ajax/agregarTmp.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados').html(datos);
      $('#id').val('');
      $('#id').focus();
      $('#barcode').val('');
      $('#barcode_qty').val('1');
      //toastr.success("&Iacute;tem agregado","Bien hecho!");
    },
  });
  event.preventDefault();
});
//Elimina del cuadro de ventas
function eliminar(id) {
  $.ajax({
    type: 'GET',
    url: '../ajax/agregarTmp.php',
    data: 'id=' + id,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados').html(datos);
    },
  });
}
//Registra
$('#guardar_cliente').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoCliente.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_cliente')[0].reset();
      $('#cliente_tipo').focus();
    },
  });
  event.preventDefault();
});
//Registra
$('#guardar_categoria').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoCategoria.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_categoria')[0].reset();
      $('#nom_categoria').focus();
    },
  });
  event.preventDefault();
});
//Registra
$('#guardar_marca').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoMarca.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_marca')[0].reset();
      $('#nom_marca').focus();
    },
  });
  event.preventDefault();
});
