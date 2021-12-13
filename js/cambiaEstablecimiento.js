/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#cambia').click(function () {
    $.ajax({
      type: 'GET',
      url: '../view/establecimientos.php',
      data: { lock: 1 },
      dataType: 'html',
      beforeSend: function () {
        $('#cambia').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#cambia').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Verificando...'
        );
        $('#load_login').html(
          '<img src="../assets/images/svg-icon/loading.svg" width="50">'
        );
        $('#load_login').addClass('ajax-loader-login');
        $('#cambiaEstablecimiento').modal('hide');
      },
      success: function (data) {
        $('#cambia').attr('disabled', true);
        $('#cancelar_salir').attr('disabled', true);
        $('#cambia').html(
          '<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Bloqueando sesi&oacute;n...'
        );
        vt.success('Estamos listando los establecimientos...', {
          duration: 5000,
          fadeDuration: 200,
          title: 'Bien hecho!',
          position: 'top-right',
        });
        //toastr["success"]("Estamos bloqueando tu sesi&oacute;n...", "Bien hecho!");
        setTimeout(' window.location.href = "../view/"; ', 2000);
      },
      error: function () {
        $('#cambia').attr('disabled', false);
        $('#cancelar_salir').attr('disabled', false);
        $('#cambia').html('S&iacute;, cambiar');
        //toastr["error"]("Ocurri&oacute; un error...", "Oops!");
        vt.error('Ocurri&oacute; un error desconocido.', {
          duration: 5000,
          fadeDuration: 200,
          title: 'Oopss!',
          position: 'top-right',
        });
      },
    });
  });
});
