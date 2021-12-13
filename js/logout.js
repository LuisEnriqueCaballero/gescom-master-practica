/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#logout').click(function () {
    $.ajax({
      type: 'GET',
      url: '../view/logout.php',
      data: { logout: 1 },
      dataType: 'html',
      beforeSend: function () {
        $('#logout').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#logout').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Verificando...'
        );
      },
      success: function (data) {
        $('#logout').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#logout').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Cerrando sesi&oacute;n...'
        );
        toastr['success'](
          'Estamos cerrando tu sesi&oacute;n...',
          'Bien hecho!'
        );
        setTimeout(' window.location.href = "../view/"; ', 2000);
      },
      error: function () {
        $('#logout').attr('disabled', false);
        $('#cancelar_salir').attr('disabled', false);
        $('#logout').html('S&iacute;, cerrar sesi&oacute;n');
        toastr['error']('Ocurri&oacute; un error...', 'Oops!');
      },
    });
  });
});
