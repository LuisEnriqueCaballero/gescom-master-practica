/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#guardar_datos1').click(function () {
    var documento_colaborador1 = $('#documento_colaborador1').val();
    var dataString = 'documento_colaborador1=' + documento_colaborador1;
    if ($.trim(documento_colaborador1).length > 0) {
      $.ajax({
        type: 'POST',
        url: '../ajax/ajaxLoginAsistencia1.php',
        data: dataString,
        cache: false,
        beforeSend: function () {
          $('#guardar_datos1').attr('disabled', true);
          $('#guardar_datos1').html('Verificando...');
          $('#load_login').html(
            '<img src="../assets/images/svg-icon/loading.svg" width="50">'
          );
          $('#load_login').addClass('ajax-loader-login');
        },
        success: function (data) {
          if (data == 2) {
            $('#documento_colaborador1').attr('disabled', false);
            $('#guardar_datos1').html('Registrando Salida...');
            toastr['success'](
              'Tu salida ha sido registrada exitosamente',
              'Bien hecho!'
            );
            $('#guardar_datos1').attr('disabled', false);
            $('#guardar_datos1').html('Registrar Salida');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
            $('#guarda_salidaColaborador')[0].reset();
          } else if (data == 3) {
            toastr['error'](
              'No encontramos el documento en nuestra base de datos',
              'Oopss!'
            );
            $('#documento_colaborador1').focus();
            $('#guardar_datos1').attr('disabled', false);
            $('#guardar_datos1').html('Registrar Salida');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
          } else if (data == 4) {
            toastr['info'](
              'Tu salida ya est&aacute; registrada en nuestra base de datos',
              'Aviso!'
            );
            $('#documento_colaborador1').focus();
            $('#guardar_datos1').attr('disabled', false);
            $('#guardar_datos1').html('Registrar Salida');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
            $('#guarda_salidaColaborador')[0].reset();
          } /*else if (data == 1) {
            $.niftyNoty({
                type: 'warning',
                icon : 'pli-exclamation icon-2x',
                message : '<strong>Oopss!</strong><br> No est&aacute;s habilitado para registrar tu salida.',
                container : 'floating',
                timer : 5000
            });
            $('#documento_colaborador1').focus();
            $('#guardar_datos1').attr("disabled", false);
            $("#guardar_datos1").html('Registrar Salida');
            $('#load_login').html('');
            $('#load_login').removeClass('ajax-loader-login');
          };*/
        },
      });
    } else {
      if (documento_colaborador1.length == 0) {
        $.niftyNoty({
          type: 'warning',
          icon: 'pli-exclamation icon-2x',
          message:
            '<strong>Oopss!</strong><br> Por favor ingresa tu documento para registrar tu salida.',
          container: 'floating',
          timer: 5000,
        });
        $('#documento_colaborador1').focus();
      }
    }
    event.preventDefault();
  });
});
