<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
//session_start();
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="editar_proveedor" name="editar_proveedor" autocomplete="off" class="form-horizontal form-validate">
   <div class="modal fade" id="editarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Editar Proveedor</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-row">
                  <input type="hidden" name="mod_idprov" id="mod_idprov">
                  <div class="form-group col-md-6">
                     <label for="mod_tipo">Tipo de documento *</label>
                     <select required id="mod_tipo" name="mod_tipo" class="form-control">
                        <option value="">SELECCIONAR</option>
                        <?php           
                           $tipo_cliente ="select * from sunat_tipocliente";
                           $row          =mysqli_query($con,$tipo_cliente);
                           while ($row4 = mysqli_fetch_array($row)) {
                              $sunat_tipoCliente_nombre = $row4["sunat_tipoCliente_nombre"];
                              $sunat_tipoCliente_id     = $row4["sunat_tipoCliente_id"];
                        ?>
                        <option value="<?php echo $sunat_tipoCliente_id;?>"><?php  echo $sunat_tipoCliente_nombre;?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="mod_documento">Documento</label>
                     <div class="input-group">
                         <input type="number" class="form-control input-sm" name="mod_documento" id="mod_documento" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Documento" required>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="mod_nombre">Nombres *</label>
                       <input type="text" class="form-control input-sm" id="mod_nombre" name="mod_nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Apellidos y nombres" required>
                   </div>
                   <div class="form-group col-md-2">
                       <label for="mod_departamento">Departamento</label>
                       <input type="text" class="form-control input-sm" id="mod_departamento" name="mod_departamento" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Departamento">
                   </div>
                   <div class="form-group col-md-2">
                       <label for="mod_provincia">Provincia</label>
                       <input type="text" class="form-control input-sm" id="mod_provincia" name="mod_provincia" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Provincia">
                   </div>
                   <div class="form-group col-md-2">
                       <label for="mod_distrito">Distrito</label>
                       <input type="text" class="form-control input-sm" id="mod_distrito" name="mod_distrito" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Distrito">
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="mod_domicilio">Domicilio *</label>
                       <input type="text" class="form-control input-sm" id="mod_domicilio" name="mod_domicilio" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Domicilio" required>
                   </div>
                   <div class="form-group col-md-6">
                       <label for="mod_pais">Pa&iacute;s</label>
                       <input type="text" class="form-control input-sm" id="mod_pais" name="mod_pais" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Pa&iacute;s">
                   </div>
               </div>
               <div class="form-row">
                   
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="mod_telefono">Tel&eacute;fono *</label>
                       <input type="text" class="form-control input-sm" id="mod_telefono" name="mod_telefono" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Tel&eacute;fono" required>
                   </div>
                   <div class="form-group col-md-6">
                       <label for="mod_email">E-Mail</label>
                       <input type="email" class="form-control input-sm" id="mod_email" name="mod_email" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="E-Mail">
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="mod_contacto">Contacto</label>
                       <input type="text" class="form-control input-sm" id="mod_contacto" name="mod_contacto" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Contacto">
                   </div>
                   <div class="form-group col-md-6">
                       <label for="mod_cargo">Cargo</label>
                       <input type="text" class="form-control input-sm" id="mod_cargo" name="mod_cargo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Cargo">
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