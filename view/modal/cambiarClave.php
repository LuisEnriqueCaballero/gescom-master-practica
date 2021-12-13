<form method="post" id="editar_password" name="editar_password" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Cambiar Contrase&ntilde;a</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax"></div>
               <div class="form-group row" style="display: none;">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_id" name="mod_id" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Usuario" autofocus="" style="height: 35px;" required value="<?php echo $_SESSION['usuario_id']; ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="password" class="form-control input-sm" id="user_password_new" name="user_password_new" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Contrase&ntilde;a *" autofocus="" style="height: 35px;" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="password" class="form-control input-sm" id="user_password_repeat" name="user_password_repeat" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Repetir contrase&ntilde;a *" autofocus="" style="height: 35px;" required>
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