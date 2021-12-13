<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
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
                     <select required id="colaborador_id" name="colaborador_id" class="form-control">
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
                     <input type="text" class="form-control input-sm" id="user_name" name="user_name" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Usuario" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contrase&ntilde;a" required onKeyUp="this.value=this.value.toUpperCase();">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contrase&ntilde;a" required onKeyUp="this.value=this.value.toUpperCase();">
                  </div>
               </div>
               <div class="form-group col-md-12">
                       <label for="user_grupo">Grupo Usuario *</label>
                       <select required id="user_grupo" name="user_grupo" class="form-control">
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
               <button type="submit" class="btn btn-primary" id="guardar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>