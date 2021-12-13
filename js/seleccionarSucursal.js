/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Cambiamos la barra de titulo
$(document).prop('title', '.:: Seleccionar Sucursal | Miracles ::.');
//
$(document).ready(function () {
  load(1);
});
//Busca los datos
function load(page) {
  $('#ldng_cat').fadeIn('slow');
  $.ajax({
    url: '../ajax/seleccionarSucursal.php',
    beforeSend: function (objeto) {},
    success: function (data) {
      $('.outer_div_cat').html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    },
  });
}
