<?php
$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "o";
}
if ($sex==2) {
   $sexo = "a";
}
?>
<div class="modal fade" id="salir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content bg-white">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Cerrar Sesi&oacute;n</h5>
         </div>
         <div class="modal-body">
            ¿Est&aacute;s segur<?php echo $sexo; ?> que deseas salir del sistema?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar_salir">No, cancelar</button>
            <button type="submit" class="btn btn-primary" id="logout">S&iacute;, cerrar sesi&oacute;n</button>
         </div>
      </div>
   </div>
</div>