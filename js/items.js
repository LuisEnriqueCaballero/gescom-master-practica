/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Items | Prizma Technology ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarItems.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    },
  });
}
//Registra
/*$("#guardar_item" ).submit(function( event ) {
  $('#guardar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevoItem.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr("disabled", false);
      $("#cod_resultado").load("../ajax/incrementaCodProducto.php");
      load(1);
      $("#guardar_item")[0].reset();
      $("#producto_codigoBarras").focus();
    }
  });
  event.preventDefault();
})*/
//Carga foto
function upload_image_mod(id_producto) {
  $('#load_img_mod').text('Cargando...');
  var inputFileImage = document.getElementById('imagefile_mod');
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('imagefile_mod', file);
  data.append('id_producto', id_producto);

  $.ajax({
    url: '../ajax/cargaImagenItem.php', // Url to which the request is send
    type: 'POST', // Type of request to be send, called as method
    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (
      data // A function to be called if request succeeds
    ) {
      $('#load_img_mod').html(data);
      load(1);
    },
  });
  event.preventDefault();
}
function carga_img(id_producto) {
  $('.outer_img').load('../ajax/imgItem.php?id_producto=' + id_producto);
}
//Obtiene los datos en el modal
function obtener_datos(id) {
  var foto_producto = $('#foto_producto' + id).val();
  $('#load_img_mod').val(foto_producto);
  $('#mod_id').val(id);
}
//
function carga_esp(id_producto) {
  $('.outer_img').load('../ajax/espItem.php?id_producto=' + id_producto);
}
//
function upload_esp_mod(id_producto) {
  $('#load_img_mod').text('Cargando...');
  var inputFileImage = document.getElementById('imagefile_mod1');
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('imagefile_mod1', file);
  data.append('id_producto', id_producto);

  $.ajax({
    url: '../ajax/cargaEspecificaciones.php', // Url to which the request is send
    type: 'POST', // Type of request to be send, called as method
    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (
      data // A function to be called if request succeeds
    ) {
      $('#load_img_mod').html(data);
      load(1);
      console.log(data);
    },
  });
  event.preventDefault();
}

//
function carga_fic(id_producto) {
  $('.outer_img').load('../ajax/fichaItem.php?id_producto=' + id_producto);
}
//
function upload_fic_mod(id_producto) {
  $('#load_img_mod').text('Cargando...');
  var inputFileImage = document.getElementById('imagefile_mod2');
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('imagefile_mod2', file);
  data.append('id_producto', id_producto);

  $.ajax({
    url: '../ajax/cargaFicha.php', // Url to which the request is send
    type: 'POST', // Type of request to be send, called as method
    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (
      data // A function to be called if request succeeds
    ) {
      $('#load_img_mod').html(data);
      load(1);
      console.log(data);
    },
  });
  event.preventDefault();
}
