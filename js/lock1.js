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
            $('#password').attr('disabled', true);
            $('#login').html('Desbloqueando...');
            toastr['success']('Te estamos redirigiendo...', 'Bien hecho!');
            setTimeout(' window.location.href = "../view/"; ', 2000);
          } else {
            $('#password').focus();
            $('#login').attr('disabled', false);
            $('#login').html('Desbloquear');
            toastr['error']('Contrase&ntilde;a incorrecta', 'Oopss!');
          }
        },
      });
    } else {
      if (password.length == 0) {
        toastr['warning']('Contrase&ntilde;a vac&iacute;a', 'Aviso');
        $('#password').focus();
      }
    }
    event.preventDefault();
  });
});
