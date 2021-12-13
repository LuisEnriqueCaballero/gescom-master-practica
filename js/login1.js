/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
$(document).ready(function () {
  $('#login').click(function () {
    var username = $('#username').val();
    var password = $('#password').val();
    var dataString = 'username=' + username + '&password=' + password;
    if ($.trim(username).length > 0 && $.trim(password).length > 0) {
      $.ajax({
        type: 'POST',
        url: '../ajax/ajaxLogin.php',
        data: dataString,
        cache: false,
        beforeSend: function () {
          $('#login').attr('disabled', true);
          $('#login').html('Verificando...');
        },
        success: function (data) {
          if (data) {
            toastr['success']('Te estamos redirigiendo...', 'Bien hecho!');
            $('#username').attr('disabled', true);
            $('#password').attr('disabled', true);
            $('#login').html('Conectando...');
            setTimeout('window.location.href = "../view/"; ', 2000);
          } else {
            toastr['error']('Datos incorrectos...', 'Oopps!');
            $('#username').focus();
            $('#login').attr('disabled', false);
            $('#login').html('Iniciar Sesi&oacute;n');
          }
        },
      });
    } else {
      if (username.length == 0 || password.length == 0) {
        toastr['warning']('Datos vac&iacute;os', 'Aviso');
        $('#username').focus();
      }
    }
    event.preventDefault();
  });
});
