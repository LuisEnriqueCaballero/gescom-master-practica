/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Abonos Proveedores | Miracles ::.');
//
$(document).ready(function () {
  //$("#widgets").load("../ajax/carga_widgets.php");
  load(1);
});
//
function load(page) {
  var range = $('#range').val();
  var id_credito = $('#id_credito').val();
  /*var parametros = {
        "action": "ajax",
        "page": page,
        'range': range,
        "id_cregito": id_cregito
    };*/
  $('#loader').fadeIn('slow');
  $.ajax({
    url:
      '../ajax/verCuentasPagar.php?action=ajax&page=' +
      page +
      '&range=' +
      range +
      '&id_credito=' +
      id_credito,
    //data: parametros,
    beforeSend: function (objeto) {
      $('#loader').html(
        "<img src='../img/company/load.svg' style='width: 50px;'>"
      );
    },
    success: function (data) {
      $('.outer_div').html(data).fadeIn('slow');
      $('#loader').html('');
    },
  });
}
//
$('#add_abono').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var abono = $('#abono').val();

  if (isNaN(abono)) {
    toastr['warning']('El abono no es un dato v&aacute;lido', 'Aviso!');
    $('#abono').focus();
    $('#guardar_datos').attr('disabled', false);
    return false;
  }

  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/agregarAbono.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#add_abono')[0].reset();
      //$("#nom_categoria").focus();
    },
  });
  event.preventDefault();
});
//

//

$('#add-stock').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id');
  var modal = $(this);
  modal.find('#mod_id').val(id);
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
$('#creditos').addClass('active');
$('#cuentasPagar').removeClass('active');
$('#cuentasCobrar').addClass('active');
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
