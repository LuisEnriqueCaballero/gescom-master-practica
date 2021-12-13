//Edita la contrasena
$("#editar_password" ).submit(function( event ) {
  $('#actualizar_datos').html('<img src="../plantilla/images/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
  $('#actualizar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/cambiarClave.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#actualizar_datos').html('Aceptar');
      $('#actualizar_datos').attr("disabled", false);
      //load(1);
      $('#change').modal('hide');
      $("#editar_password")[0].reset();
      $('#user_password_new').val('');
      $('#user_password_repeat').val('');
      $('#user_password_new').focus();
    }
  });
  event.preventDefault();
})