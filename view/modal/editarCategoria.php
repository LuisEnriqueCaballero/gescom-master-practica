<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
session_start();
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="editar_categoria" name="editar_categoria" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="editarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Editar Categor&iacute;a</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_categoria" name="mod_categoria" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre" autofocus="" required>
                     <input type="hidden" name="mod_id" id="mod_id">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_descripcion" name="mod_descripcion" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Descripci&oacute;n" value="--" required>
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