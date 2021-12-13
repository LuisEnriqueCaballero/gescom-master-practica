<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
 $('#mod_marca').val(nom_marca);
  $('#mod_descripcion').val(desc_marca);
  $('#mod_idEstablecimiento').val(id);
---------------------------*/
/* Connect To Database*/
//session_start();
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="editar_accesoUsuario" name="editar_accesoUsuario" autocomplete="off" class="form-horizontal form-validate">
   <div class="modal fade" id="editarAccesoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Editar Grupo Usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-row">
                  <input type="hidden" name="mod_idAccesoUsuario" id="mod_idAccesoUsuario">
                  
                  <div class="form-group col-md-12">
                       <label for="mod_nombreAcceso">Nombre *</label>
                       <input type="text" class="form-control input-sm" id="mod_nombreAcceso" name="mod_nombreAcceso" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre de Establecimiento" required>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary" id="actualizar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>