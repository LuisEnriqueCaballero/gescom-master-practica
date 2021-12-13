/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Proveedores | Prizma Technology ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarProveedores.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    },
  });
}
//Registra
$('#guardar_proveedor').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoProveedor.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_proveedor')[0].reset();
      $('#cliente_tipo').focus();
    },
  });
  event.preventDefault();
});
//Edita
$('#editar_proveedor').submit(function (event) {
  $('#actualizar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#actualizar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/editarProveedor.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax2').html(datos);
      $('#actualizar_datos').html('Aceptar');
      $('#actualizar_datos').attr('disabled', false);
      load(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
//Elimina
$('#eliminarProveedor').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id'); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find('#id_proveedor').val(id);
});

$('#eliminarDatos').submit(function (event) {
  $('#eliminar').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#eliminar').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/eliminarProveedor.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('.datos_ajax_delete').html(datos);
      $('.datos_ajax_delete').html('');
      $('.datos_ajax_delete').removeClass('ajax-loader');
      $('#eliminar').html('S&iacute;, continuar');
      $('#eliminar').attr('disabled', false);
      $('#eliminarProveedor').modal('hide');
      load(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
//Obtiene los datos en el modal
function obtener_datos(id) {
  debugger;
  var cliente_tipo = $('#cliente_tipo' + id).val();
  var documento_colaborador = $('#documento_colaborador' + id).val();
  var cliente_nombre = $('#cliente_nombre' + id).val();
  var cliente_departamento = $('#cliente_departamento' + id).val();
  var cliente_provincia = $('#cliente_provincia' + id).val();
  var cliente_distrito = $('#cliente_distrito' + id).val();
  var cliente_direccion = $('#cliente_direccion' + id).val();
  var cliente_pais = $('#cliente_pais' + id).val();
  var cliente_telefono = $('#cliente_telefono' + id).val();
  var cliente_email = $('#cliente_email' + id).val();
  var cliente_contacto = $('#cliente_contacto' + id).val();
  var cliente_cargo = $('#cliente_cargo' + id).val();
  $('#mod_tipo').val(cliente_tipo);
  $('#mod_documento').val(documento_colaborador);
  $('#mod_nombre').val(cliente_nombre);
  $('#mod_departamento').val(cliente_departamento);
  $('#mod_provincia').val(cliente_provincia);
  $('#mod_distrito').val(cliente_distrito);
  $('#mod_domicilio').val(cliente_direccion);
  $('#mod_pais').val(cliente_pais);
  $('#mod_telefono').val(cliente_telefono);
  $('#mod_email').val(cliente_email);
  $('#mod_contacto').val(cliente_contacto);
  $('#mod_cargo').val(cliente_cargo);
  $('#mod_idprov').val(id);
}
//Obtiene los datos en el modal
$('#detallesProveedor').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id');
  var tipo = button.data('tipo');
  var documento = button.data('documento');
  var nombre = button.data('nombre');
  var nombre1 = button.data('nombre1');
  var direccion = button.data('direccion');
  var telefono = button.data('telefono');
  var email = button.data('email');
  var contacto = button.data('contacto');
  var cargo = button.data('cargo');
  var extra = button.data('extra');
  var registro = button.data('registro');
  var modal = $(this);
  modal.find('#id_proveedor').val(id);
  modal.find('#cliente_tipo').text(tipo);
  modal.find('#cliente_documento').text(documento);
  modal.find('#cliente_nombre').text(nombre);
  modal.find('#cliente_nombre1').text(nombre1);
  modal.find('#cliente_direccion').text(direccion);
  modal.find('#cliente_telefono').text(telefono);
  modal.find('#cliente_email').text(email);
  modal.find('#cliente_contacto').text(contacto);
  modal.find('#cliente_cargo').text(cargo);
  modal.find('#cliente_extra').text(extra);
  modal.find('#cliente_registro').text(registro);
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
$('#personas').addClass('active');
$('#clientes').removeClass('active');
$('#proveedores').addClass('active');
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
$('#historialVentas').removeClass('active');
$('#historialPagos').removeClass('active');
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
