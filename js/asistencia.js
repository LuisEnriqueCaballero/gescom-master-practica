/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#guardar_datos').click(function () {
    var documento_colaborador = $('#documento_colaborador').val();
    var dataString = 'documento_colaborador=' + documento_colaborador;
    if ($.trim(documento_colaborador).length > 0) {
      $.ajax({
        type: 'POST',
        url: '../ajax/ajaxLoginAsistencia.php',
        data: dataString,
        cache: false,
        beforeSend: function () {
          $('#guardar_datos').attr('disabled', true);
          $('#guardar_datos').html('Verificando...');
          $('#load_login').html(
            '<img src="../assets/images/svg-icon/loading.svg" width="50">'
          );
          $('#load_login').addClass('ajax-loader-login');
        },
        success: function (data) {
          if (data == 2) {
            $('#documento_colaborador').attr('disabled', false);
            $('#guardar_datos').html('Registrando Asistencia...');
            toastr['success'](
              'Tu asistencia ha sido registrada exitosamente',
              'Bien hecho!'
            );
            $('#guardar_datos').attr('disabled', false);
            $('#guardar_datos').html('Registrar Asistencia');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
            $('#guarda_asistencia')[0].reset();
          } else if (data == 3) {
            toastr['error'](
              'No encontramos el documento en nuestra base de datos',
              'Oopss!'
            );
            $('#documento_colaborador').focus();
            $('#guardar_datos').attr('disabled', false);
            $('#guardar_datos').html('Registrar Asistencia');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
          } else if (data == 4) {
            toastr['info'](
              'Tu asistencia ya est&aacute; registrada en nuestra base de datos',
              'Aviso!'
            );
            $('#documento_colaborador').focus();
            $('#guardar_datos').attr('disabled', false);
            $('#guardar_datos').html('Registrar Asistencia');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
            $('#guarda_asistencia')[0].reset();
          } /*else if (data == 1) {
            $.niftyNoty({
                type: 'warning',
                icon : 'pli-exclamation icon-2x',
                message : '<strong>Oopss!</strong><br> No est&aacute;s habilitado para registrar tu asistencia.',
                container : 'floating',
                timer : 5000
            });
            $('#documento_colaborador').focus();
            $('#guardar_datos').attr("disabled", false);
            $("#guardar_datos").html('Registrar Asistencia');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
          };*/
        },
      });
    } else {
      if (documento_colaborador.length == 0) {
        $.niftyNoty({
          type: 'warning',
          icon: 'pli-exclamation icon-2x',
          message:
            '<strong>Oopss!</strong><br> Por favor ingresa tu documento para registrar tu asistencia.',
          container: 'floating',
          timer: 5000,
        });
        $('#documento_colaborador').focus();
      }
    }
    event.preventDefault();
  });
});
