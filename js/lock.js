/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#lock').click(function () {
    $.ajax({
      type: 'GET',
      url: '../lock/',
      data: { lock: 1 },
      dataType: 'html',
      beforeSend: function () {
        $('#lock').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#lock').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Verificando...'
        );
      },
      success: function (data) {
        $('#lock').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#lock').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Bloqueando sesi&oacute;n...'
        );
        toastr['success'](
          'Estamos bloqueando tu sesi&oacute;n...',
          'Bien hecho!'
        );
        setTimeout(' window.location.href = "../lockscreen/"; ', 2000);
      },
      error: function () {
        $('#lock').attr('disabled', false);
        $('#cancelar_salir').attr('disabled', false);
        $('#lock').html('S&iacute;, bloquear sesi&oacute;n');
        toastr['error']('Ocurri&oacute; un error...', 'Oops!');
      },
    });
  });
});
