/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Cargos | Prizma Technology ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarCargos.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    },
  });
}
//Registra
$('#guardar_cargo').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoCargo.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_cargo')[0].reset();
      $('#cargo_nombre').focus();
    },
  });
  event.preventDefault();
});
//Edita
$('#editar_cargo').submit(function (event) {
  $('#actualizar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#actualizar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/editarCargo.php',
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
$('#eliminarCargo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id'); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find('#id_cargo').val(id);
});
$('#eliminarDatos').submit(function (event) {
  $('#eliminar').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#eliminar').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/eliminarCargo.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('.datos_ajax_delete').html(datos);
      $('.datos_ajax_delete').html('');
      $('.datos_ajax_delete').removeClass('ajax-loader');
      $('#eliminar').html('S&iacute;, continuar');
      $('#eliminar').attr('disabled', false);
      $('#eliminarCargo').modal('hide');
      load(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
//Obtiene los datos en el modal
function obtener_datos(id) {
  var cargo_nombre = $('#cargo_nombre' + id).val();
  $('#mod_nombre').val(cargo_nombre);
  $('#mod_idCargo').val(id);
}
//Modificamos el mueno lateral
$('#container').addClass('mainnav-lg');
$('#container').removeClass('mainnav-sm page-fixedbar');
//Marcamos el menu lateral
$('#inicio').removeClass('active-link');
$('#pos').removeClass('active-link');
$('#notas').removeClass('active-link');
$('#anuncios').removeClass('active-link');
$('#calendario').removeClass('active-link');
$('#archivos').removeClass('active-link');
//Modulo archivos
$('#caja').removeClass('active-sub');
$('#ulCaja').removeClass('in');
$('#CajaActual').removeClass('active-link');
$('#Movimientos').removeClass('active-link');
//Modulo personas
$('#personas').removeClass('active-sub');
$('#ulPersonas').removeClass('in');
$('#clientes').removeClass('active-link');
$('#proveedores').removeClass('active-link');
$('#colaboradores').removeClass('active-link');
//Modulo restaurante
$('#restaurante').removeClass('active-sub');
$('#ulRestaurante').removeClass('in');
$('#mesas').removeClass('active-link');
$('#seccionesR').removeClass('active-link');
$('#insumos').removeClass('active-link');
//Modulo hospedaje
$('#hospedaje').removeClass('active-sub');
$('#ulHospedaje').removeClass('in');
$('#habitaciones').removeClass('active-link');
$('#seccionesH').removeClass('active-link');
//Modulo escuela
$('#escuela').removeClass('active-sub');
$('#ulEscuela').removeClass('in');
$('#estudiantes').removeClass('active-link');
$('#profesores').removeClass('active-link');
$('#padres').removeClass('active-link');
$('#calificaciones').removeClass('active-link');
$('#horarios').removeClass('active-link');
$('#asistenciaE').removeClass('active-link');
//Modulo clinica
$('#clinica').removeClass('active-sub');
$('#ulClinica').removeClass('in');
$('#admision').removeClass('active-link');
$('#topico').removeClass('active-link');
$('#historias').removeClass('active-link');
$('#especialidades').removeClass('active-link');
$('#medicos').removeClass('active-link');
$('#atencion').removeClass('active-link');
//Modulo marketing
$('#marketing').removeClass('active-sub');
$('#ulMarketing').removeClass('in');
$('#mktEmail').removeClass('active-link');
$('#mktWhatsApp').removeClass('active-link');
//Modulo articulos
$('#articulos').removeClass('active-sub');
$('#ulArticulos').removeClass('in');
$('#marcas').removeClass('active-link');
$('#categorias').removeClass('active-link');
$('#items').removeClass('active-link');
$('#kardex').removeClass('active-link');
$('#traslados').removeClass('active-link');
$('#ajustarInventario').removeClass('active-link');
//Modulo ventas
$('#ventas').removeClass('active-sub');
$('#ulVentas').removeClass('in');
$('#nuevaVenta').removeClass('active-link');
$('#nuevaFactura').removeClass('active-link');
$('#nuevoPedido').removeClass('active-link');
$('#historialVentas').removeClass('active-link');
//Modulo cotizaciones
$('#cotizaciones').removeClass('active-sub');
$('#ulCotizaciones').removeClass('in');
$('#nuevaCotizacion').removeClass('active-link');
$('#historialCotizaciones').removeClass('active-link');
//Modulo egresos
$('#egresos').removeClass('active-sub');
$('#ulEgresos').removeClass('in');
$('#nuevaCompra').removeClass('active-link');
$('#historialCompras').removeClass('active-link');
$('#categoriaGastos').removeClass('active-link');
$('#historialGastos').removeClass('active-link');
//Modulo facturacion electronica
$('#facturacionElectronica').removeClass('active-sub');
$('#ulFacturacionElectronica').removeClass('in');
$('#notaDebito').removeClass('active-sub');
$('#ulNotaDebito').removeClass('in');
$('#nuevaNotaDebitoFactura').removeClass('active-link');
$('#nuevaNotaDebitoBoleta').removeClass('active-link');
$('#notaCredito').removeClass('active-sub');
$('#ulNotaCredito').removeClass('in');
$('#nuevaNotaCreditoFactura').removeClass('active-link');
$('#nuevaNotaCreditoBoleta').removeClass('active-link');
$('#resumenDiario').removeClass('active-link');
$('#documentosElectronicos').removeClass('active-link');
$('#comunicacionBaja').removeClass('active-link');
$('#guiaRemision').removeClass('active-link');
//Modulo contabilidad
$('#contabilidad').removeClass('active-sub');
$('#ulContabilidad').removeClass('in');
$('#librosElectronicos').removeClass('active-sub');
$('#ulLibros').removeClass('in');
$('#cajaBancos').removeClass('active-sub');
$('#ulCajaBancos').removeClass('in');
$('#mEfectivo').removeClass('active-link');
$('#mCorriente').removeClass('active-link');
$('#registroInventarios').removeClass('active-link');
$('#registroCompras').removeClass('active-link');
$('#registroVentas').removeClass('active-link');
$('#libroDiario').removeClass('active-link');
$('#libroMayor').removeClass('active-link');
$('#listaBancos').removeClass('active-link');
$('#cuentasBancarias').removeClass('active-link');
$('#medioPagos').removeClass('active-link');
$('#pcge').removeClass('active-link');
//Modulo creditos
$('#creditos').removeClass('active-sub');
$('#ulCreditos').removeClass('in');
$('#cuentasPagar').removeClass('active-link');
$('#cuentasCobrar').removeClass('active-link');
//Modulo rrhh
$('#rrhh').addClass('active-sub');
$('#ulRH').addClass('in');
$('#variablesDescansos').removeClass('active-link');
$('#consultaAsistencia').removeClass('active-link');
$('#listaAsistencia').removeClass('active-link');
$('#listaDescanso').removeClass('active-link');
$('#vacaciones').removeClass('active-link');
$('#contratos').removeClass('active-link');
$('#cargos').addClass('active-link');
$('#pagos').removeClass('active-link');
$('#planilla').removeClass('active-link');
//Modulo crm
$('#crm').removeClass('active-sub');
$('#ulCRM').removeClass('in');
$('#tareas').removeClass('active-link');
$('#proyectos').removeClass('active-link');
$('#callCenter').removeClass('active-link');
$('#propuestas').removeClass('active-link');
$('#presupuestos').removeClass('active-link');
$('#historialTickets').removeClass('active-link');
$('#clientesPotenciales').removeClass('active-link');
//Modulo ajustes
$('#ajustes').removeClass('active-sub');
$('#ulAjustes').removeClass('in');
$('#datosEmpresa').removeClass('active-link');
$('#establecimientos').removeClass('active-link');
$('#seriesCorrelativos').removeClass('active-link');
$('#cuentasUsuarios').removeClass('active-link');
$('#accesosUsuarios').removeClass('active-link');
$('#logsUsuarios').removeClass('active-link');
$('#almacenes').removeClass('active-link');
$('#respaldo').removeClass('active-link');
$('#backup').removeClass('active-link');
//Modulo reportes
$('#reportes').removeClass('active-sub');
$('#ulReportes').removeClass('in');
$('#gastos').removeClass('active-link');
$('#reporteVentas').removeClass('active-sub');
$('#ulReporteVentas').removeClass('in');
$('#ventasUsuario').removeClass('active-link');
$('#ventasCliente').removeClass('active-link');
$('#ventasResumen').removeClass('active-link');
$('#reporteCompras').removeClass('active-sub');
$('#ulReporteComras').removeClass('in');
$('#comprasUsuario').removeClass('active-link');
$('#comprasProveedor').removeClass('active-link');
$('#comprasResumen').removeClass('active-link');
$('#consolidado').removeClass('active-link');
$('#balanceProductos').removeClass('active-link');
$('#utilidadesProductos').removeClass('active-link');
$('#gastosVSingresos').removeClass('active-link');
