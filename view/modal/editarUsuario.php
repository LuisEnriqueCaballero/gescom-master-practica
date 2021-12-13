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
<form method="post" id="editar_usuario" name="editar_usuario" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Editar Marca</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
              <input type="hidden" name="mod_id" id="mod_id">
               <div class="form-group row">
                  <div class="col-sm-12">
                     <select required id="mod_colaborador" name="mod_colaborador" class="form-control">
                        <option value="">SELECCIONAR COLABORADOR</option>
                        <?php
                           $tienda = $_SESSION['tienda'];
                           $tipo_cliente ="select * from colaboradores where colaborador_sucursal='$tienda'";
                           $row          =mysqli_query($con,$tipo_cliente);
                           while ($row4 = mysqli_fetch_array($row)) {
                              $colaborador_nombres = $row4["colaborador_nombres"];
                              $colaborador_id     = $row4["colaborador_id"];
                        ?>
                        <option value="<?php echo $colaborador_id;?>"><?php  echo $colaborador_nombres;?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_usuario" name="mod_usuario" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Usuario" autofocus="" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_password" name="mod_password" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Contrase&ntilde;a" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                     <input type="text" class="form-control input-sm" id="mod_password_r" name="mod_password_r" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Repite contrase&ntilde;a" required>
                  </div>
               </div>
               <div class="form-group col-md-12">
                       <label for="mod_user_grupo">Grupo Usuario *</label>
                       <select required id="mod_user_grupo" name="mod_user_grupo" class="form-control">
                          <option value="">SELECCIONAR</option>
                          <?php           
                             $cargo ="select * from grupo_usuario where estado_grupo=1";
                             $rw_cargo          =mysqli_query($con,$cargo);
                             while ($rw_cargo4 = mysqli_fetch_array($rw_cargo)) {
                                $almacen_nombre = $rw_cargo4["nombre_grupo"];
                                $almacen_id     = $rw_cargo4["id_grupo"];
                          ?>
                          <option value="<?php echo $almacen_id;?>"><?php  echo $almacen_nombre;?></option>
                          <?php } ?>
                       </select>
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