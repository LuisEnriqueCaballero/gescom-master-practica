<div class='modal fade' id='detallesCliente' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
   <div class='modal-dialog modal-lg' role='document'>
      <div class='modal-content bg-white'>
         <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalCenterTitle'><span id="cliente_nombre"></span></h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
         </div>
         <div class='modal-body'>
          <input type='hidden' name='id_cliente' id='id_cliente'>
           <div class='row align-items-center'>
              <div class='col-12 col-md-4'>
                  <img src='../img/client/client.png' class='img-fluid'>
              </div>
              <div class='col-12 col-md-8'>
                  <h5 class='card-title mb-1'><span id="cliente_nombre1"></span></h5>
                  <p class='mb-0 font-12 font-italic'><span id="cliente_direccion"></span></p><hr>
                  <b><span id="cliente_tipo"></span>:</b> <span id="cliente_documento"></span><br>
                  <b>Tel&eacute;fono:</b> <span id="cliente_telefono"></span><br>
                  <b>E-Mail:</b> <span id="cliente_email"></span><br>
                  <b>Contacto:</b> <span id="cliente_contacto"></span><br>
                  <b>Cargo:</b> <span id="cliente_cargo"></span><br>
                  <b>Extra:</b> <span id="cliente_extra"></span><br>
                  <b>F. Registro:</b> <span id="cliente_registro"></span>
              </div>
          </div>
         </div>
         <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
         </div>
      </div>
   </div>
</div>