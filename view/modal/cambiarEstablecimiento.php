<?php
$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "o";
}
if ($sex==2) {
   $sexo = "a";
}
?>
<div class="modal fade" id="cambiaEstablecimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content bg-white">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            <h4 class="modal-title">Cambiar Establecimiento</h4>
         </div>
         <div class="modal-body">
            ¿Est&aacute;s segur<?php echo $sexo; ?> que deseas cambiar de establecimiento?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar_salir">No, cancelar</button>
            <button type="submit" class="btn btn-primary" id="cambia">S&iacute;, cambiar</button>
         </div>
      </div>
   </div>
</div>