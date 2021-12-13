<?php
$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "o";
}
if ($sex==2) {
   $sexo = "a";
}
?>
<form id="eliminarDatos">
   <div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">¿Est&aacute;s segur<?php echo $sexo; ?>?</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
            	<div class="datos_ajax_delete"></div>
            	<input type="hidden" id="id_usuario" name="id_usuario">
               Esta acci&oacute;n eliminar&aacute; de forma permanente el registro. ¿Deseas continuar?
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No, cancelar</button>
               <button type="submit" class="btn btn-primary" id="eliminar">S&iacute;, continuar</button>
            </div>
         </div>
      </div>
   </div>
</form>