/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Ventas Usuario | Miracles ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
/*function load(page){
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarConsolidado.php',
    beforeSend: function(objeto){ },
    success:function(data){
      $(".outer_div_cat").html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    }
  })
}*/

function load(page) {
  var range = $('#range').val();
  var employee_id = $('#employee_id').val();
  var moneda_id = $('#moneda_id').val();
  var parametros = {
    action: 'ajax',
    page: page,
    range: range,
    employee_id: employee_id,
    moneda_id: moneda_id,
  };
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarVentasUsuario.php',
    data: parametros,
    beforeSend: function (objeto) {
      //$('#loader').html('<img src="assets/itsolution24/img/loading2.gif">');
      //$('#loader').addClass('ajax-loader');
    },
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
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
$('#reportes').addClass('active');
$('#gastos').removeClass('active');
$('#reporteVentas').addClass('active');
$('#ventasUsuario').addClass('active');
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
