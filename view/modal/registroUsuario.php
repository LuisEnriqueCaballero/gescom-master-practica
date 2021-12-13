<form method="post" id="guardar_usuario" name="guardar_usuario" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Crear Usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="user_name" name="user_name" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Usuario" required>
                     <input type="hidden" id="colaborador_id" name="colaborador_id">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contrase&ntilde;a" equired onKeyUp="this.value=this.value.toUpperCase();">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contrase&ntilde;a" required onKeyUp="this.value=this.value.toUpperCase();">
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