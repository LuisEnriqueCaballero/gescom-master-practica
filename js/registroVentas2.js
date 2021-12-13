/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Registro Ventas | Prizma Technology ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  var range = $('#range').val();
  var moneda = $('#moneda').val();
  var parametros = { action: 'ajax', page: page, range: range, moneda: moneda };
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/buscarRegistroVentas.php',
    data: parametros,
    beforeSend: function (objeto) {
      $('#ldng_cat').html(
        '<img src="../img/company/pacman.gif" style="width: 50px;"> &nbsp; Cargando Registros...'
      );
    },
    success: function (data) {
      if (data != '') {
        $('.outer_div_cat').html(data).fadeIn('slow');
        $('#ldng_cat').html('');
        //console.log(data);
        //alert('Error');
      } else {
        alert('Error');
      }
    },
  });
}
