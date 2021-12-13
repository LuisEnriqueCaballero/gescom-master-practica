$(document). prop('title', '.:: Almacenes | Prizma Technology ::.');

$(document).ready(function(){
  load(1);
});
//Busca las categorias
function load(page){
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarVentas.php',
    beforeSend: function(objeto){ },
    success:function(data){
      $(".outer_div_cat").html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    }
  })
}
//Registra
$('#guardar_almacen').submit(function (event) {
  $('#guardar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#guardar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  alert(parametros);
  console.log(parametros);
  $.ajax({
    type: 'POST',
    url: '../ajax/nuevoAlmacen.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax').html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr('disabled', false);
      load(1);
      $('#guardar_almacen')[0].reset();
      $('#nombre_almacen').focus();
    },
  });
  event.preventDefault();
});
//Obtiene los datos en el modal
function obtener_datos(id) {
  //alert('id es:'+id);
  var nom_almacen= $('#nom_almacen' + id).val();
  var dire_almacen = $('#direc_almacen' + id).val();
  var sucur_almacen = $('#sucursal_almacen' + id).val();
  //alert('e:'+nom_establecimiento);
  $('#mod_nombre').val(nom_almacen);
  $('#mod_direccion').val(dire_almacen);
  $('#mod_sucursal').val(sucur_almacen);
  $('#mod_idAlmacen').val(id);
}
//Edita
$('#editar_almacen').submit(function (event) {
  $('#actualizar_datos').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#actualizar_datos').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/editarAlmacen.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('#resultados_ajax2').html(datos);
      $('#actualizar_datos').html('Aceptar');
      $('#actualizar_datos').attr('disabled', false);
      load(1);
      loadS(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
//Elimina
$('#eliminar_almacen').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data('id'); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find('#id_almacen').val(id);
});
$('#eliminarDatos').submit(function (event) {
  $('#eliminar').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#eliminar').attr('disabled', true);
  var parametros = $(this).serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/eliminarAlmacen.php',
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (datos) {
      $('.datos_ajax_delete').html(datos);
      $('.datos_ajax_delete').html('');
      $('.datos_ajax_delete').removeClass('ajax-loader');
      $('#eliminar').html('S&iacute;, continuar');
      $('#eliminar').attr('disabled', false);
      $('#eliminar_almacen').modal('hide');
      load(1);
      //console.log(datos);
    },
  });
  event.preventDefault();
});
