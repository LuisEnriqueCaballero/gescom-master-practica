<form method="post" id="guardar_categoria" name="guardar_categoria" autocomplete="off" class="form-horizontal needs-validation" novalidate>
   <div class="modal fade" id="nuevoCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document" style="box-shadow: 2px 2px 10px #666">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nueva Categor&iacute;a</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax"></div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="nom_categoria" name="nom_categoria" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre" autofocus="" required>
                     <div class="valid-feedback">
                        Looks good!
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="desc_categoria" name="desc_categoria" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Descripci&oacute;n" value="--" required>
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
   $("#nom_categoria").focus();
</script>