<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="generar_enlace" name="generar_enlace" autocomplete="off" class="form-horizontal">
  <div id="resultados_ajax"></div>
  <div class='modal fade' id='enviarWhatsApp' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content bg-white'>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
          <h4 class="modal-title"><span id="titulo"></span></h4>
        </div>
        <div class='modal-body'>
          <input type='hidden' name='id_factura' id='id_factura'>

          <div class="row">
             <div class="form-group col-md-12">
                 <label for="codigo">Pa&iacute;s *</label>
                 <select class="form-control selectEnvWha" id="codigo" name="codigo" required style="width: 100%;">
                  <option value="">SELECCIONAR</option>
                  <?php           
                    $tipo_cliente = "select * from codigopais";
                    $row          = mysqli_query($con,$tipo_cliente);
                    while ($row4 = mysqli_fetch_array($row)) {
                      $nombre = $row4["nombre"];
                      $phone_code = $row4["phone_code"];
                  ?>
                  <option value="<?php echo $phone_code;?>"><?php echo $nombre." | ".$phone_code;?></option>
                  <?php } ?>
                </select>
             </div>
             <div class="form-group col-md-12">
                 <label for="desc_categoria">Tel&eacute;fono *</label>
                 <input type="text" class="form-control" name="cliente_telefono" id="cliente_telefono" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Tel&eacute;fono" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
             </div>
         </div>
        </div>
        <div class='modal-footer'>
          <button type="submit" id="btnEnviar" class="input-group-addon btn btn-primary"><i class="fa fa-send"></i></button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
/*$('.selectEnvWha').select2({
  placeholder: 'Selecciona una opcion',
  width: 'resolve',
  dropdownParent: $("#enviarWhatsApp")
  //theme: "classic"
});*/
</script>
<script>
$("#cliente_telefono").focus();

//Registra
$("#generar_enlace" ).submit(function( event ) {
  $('#btnEnviar').html('<img src="../img/company/load1.svg" style="width: 20px;">');
  $('#btnEnviar').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/generarEnlaceCot.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#btnEnviar').html('<i class="fa fa-send"></i>');
      $('#btnEnviar').attr("disabled", false);
      //load(1);
      //$("#generar_enlace")[0].reset();
      $("#cliente_telefono").focus();
    }
  });
  event.preventDefault();
})
</script>