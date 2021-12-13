/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Nueva Cotizacion | Miracles ::.');
//Cargamos el tipo de documento
$(document).ready(function () {
  $('#tipoDocumentoT').text('cotizacion');
  $('#resultados').load('../ajax/agregarTmpCotizaciones.php');
  $('#tipoDocumento').load('../ajax/documentos/cambiaTipoCotizacion.php');
  $('#cambiaFolio').load('../ajax/documentos/cambiaCotizacion.php');
  $('#cambiaCorrelativo').load('../ajax/documentos/cambiaCotizacion1.php');
  $('#tituloSerie').load('../ajax/cargaTituloSerie2.php');

  $('#cliente_nombre1').val('');
  $('#id_cliente').val('');
  $('#cliente_documento').val('');
  $('#cliente_telefono').val('');
  $('#cliente_direccion').val('');

  $('#cliente_nombre1').focus();
  load(1);

  //setInterval(
  //function(){
  //$('#cambiaCorrelativo').load('../ajax/documentos/cambiaBoleta1.php');
  //},1000
  //);
  //Funcion autocompletar
  $(function () {
    $('#cliente_nombre1').autocomplete({
      source: '../ajax/autocomplete/clientesNatural.php',
      minLength: 2,
      select: function (event, ui) {
        event.preventDefault();
        $('#id_cliente').val(ui.item.id_cliente);
        $('#cliente_nombre1').val(ui.item.cliente_nombre);
        $('#cliente_documento').val(ui.item.cliente_documento);
        $('#cliente_telefono').val(ui.item.cliente_telefono);
        $('#cliente_direccion').val(ui.item.cliente_direccion);
        toastr.success('Cliente seleccionado', 'Bien hecho!');
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
//
function load(page) {
  var q = $('#q').val();
  var id_categoria = $('#id_categoria').val();
  $('#loader').fadeIn('slow');
  $.ajax({
    url:
      '../ajax/productosVenta.php?action=ajax&page=' +
      page +
      '&q=' +
      q +
      '&id_categoria=' +
      id_categoria,
    beforeSend: function (objeto) {
      //$('#loader').html('<img src="../img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $('.outer_div').html(data).fadeIn('slow');
      $('#loader').html('');
    },
  });
}
//
function agregar(id) {
  var precio_venta = document.getElementById('precio_venta_' + id).value;
  var cantidad = document.getElementById('cantidad_' + id).value;
  //Inicia validacion
  if (isNaN(cantidad)) {
    //$.Notification.notify('error','bottom center','NOTIFICACIÓN', 'LA CANTIDAD NO ES UN NUMERO, INTENTAR DE NUEVO')
    toastr['warning']('La cantidad no es un n&uacute;mero', 'Aviso!');
    document.getElementById('cantidad_' + id).focus();
    return false;
  }
  if (isNaN(precio_venta)) {
    //$.Notification.notify('error','bottom center','NOTIFICACIÓN', 'EL PRECIO NO ES UN NUMERO, INTENTAR DE NUEVO')
    toastr['warning']('El precio no es un n&uacute;mero', 'Aviso!');
    document.getElementById('precio_venta_' + id).focus();
    return false;
  }
  //Fin validacion
  $.ajax({
    type: 'POST',
    url: '../ajax/agregarTmpModalCotizaciones.php',
    data:
      'id=' +
      id +
      '&precio_venta=' +
      precio_venta +
      '&cantidad=' +
      cantidad +
      '&operacion=' +
      2,
    beforeSend: function (objeto) {
      //$("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (datos) {
      $('#resultados').html(datos);
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
    toastr['warning']('La cantidad no es un n&uacute;mero', 'Aviso!');
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
    url: '../ajax/agregarTmpCotizaciones.php',
    data: parametros,
    beforeSend: function (objeto) {
      //$("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (datos) {
      $('#resultados').html(datos);
      $('#id').val('');
      $('#id').focus();
      $('#barcode').val('');
      //$("#f_resultado").load("../ajax/incrementa_factura.php"); //Actualizamos el numero de Factura
    },
  });
  event.preventDefault();
});
//Elimina del cuadro de ventas
function eliminar(id) { 
  $.ajax({
    type: 'GET',
    url: '../ajax/agregarTmpCotizaciones.php',
    data: 'id=' + id,
    beforeSend: function (objeto) {
      //$("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (datos) {
      $('#resultados').html(datos);
    },
  });
}

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
$('#nuevaCotizacion').addClass('active');
$('#historialCotizaciones').removeClass('active');
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
