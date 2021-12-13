<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
$tienda = $_SESSION['tienda'];
?>
<form method="post" id="guardar_accesoUsuario" name="guardar_accesoUsuario" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoAccesoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Grupo de Usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="nombre_accesoUsuario">Nombre *</label>
                     <input type="text" class="form-control input-sm" id="nombre_accesoUsuario" name="nombre_accesoUsuario" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre del Almacen" required>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary" id="guardar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>
<script>
  
</script>