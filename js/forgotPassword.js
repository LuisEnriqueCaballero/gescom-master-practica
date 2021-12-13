/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  //$('#txt_email').focus();
  $('#fgp').submit(function (event) {
    $('#forgot').html('Verificando...');
    $('#forgot').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/ajaxForgot.php',
      data: parametros,
      beforeSend: function (objeto) {},
      success: function (datos) {
        $('#resultados_ajax').html(datos);
        $('#forgot').html('Enviar Contrase&ntilde;a');
        $('#forgot').attr('disabled', false);
        //load(1);
        $('#fgp')[0].reset();
        $('#txt_email').val('');
      },
    });
    event.preventDefault();
  });
});
