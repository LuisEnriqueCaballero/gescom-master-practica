<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
?>
<form method="post" id="enviar_correo" name="enviar_correo" autocomplete="off" class="form-horizontal">
  <div id="resultados_ajax"></div>
  <div class='modal fade' id='enviarCorreo' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content bg-white'>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
          <h4 class="modal-title"><span id="titulo"></span></h4>
        </div>
        <div class='modal-body'>
          <input type='hidden' name='id_factura' id='id_factura'>
          <input type="email" class="form-control" name="cliente_correo" id="cliente_correo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Correo Electr&oacute;nico" required>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
          <button type="submit" id="enviar_datos" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</form>
  
<script>
//$('.select2-single').select2();
//$("#cliente_correo").focus();

//Registra
$("#enviar_correo" ).submit(function( event ) {
  $('#enviar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;">');
  $('#enviar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/ajaxEnviarCorreoCot.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#enviar_datos').html('<i class="fa fa-send"></i>');
      $('#enviar_datos').attr("disabled", false);
      //load(1);
      //$("#enviar_correo")[0].reset();
      $("#cliente_correo").focus();
      console.log(datos);
    }
  });
  event.preventDefault();
})
</script>