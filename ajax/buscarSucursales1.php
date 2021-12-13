<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
include("../config/db.php");
include("../config/conexion.php");
$sql = "select * from sucursales order by sucursal_id desc";
$query = mysqli_query($con,$sql);
$categoriaData = array();
$a = 1;
while ($row = mysqli_fetch_array($query)) {
    $sucursal_id            = $row['sucursal_id'];
    $sucursal_nombre        = $row['sucursal_nombre'];
    $sucursal_direccion   = $row['sucursal_direccion'];

    $principal = 1;

    if ($sucursal_id == $principal) {
        $display ='none';
    } else {
        $display = '';
    }

    $categoriaData['data'][] = array (
        0 => $a++,
        1 => $sucursal_nombre,
        2 => $sucursal_direccion,
        3 => "<input type='hidden' value='nom2' id='sucur_nom".$sucursal_id."'>
              <input type='hidden' value='".$sucursal_direccion."' id='direc_sucursal_".$sucursal_id."'>
                <div class='btn-group dropleft dropup'>
                    <button class='btn btn-primary btn-outline dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='feather icon-settings'></i></button>
                    <div class='dropdown-menu' aria-labelledby='CustomdropdownMenuButton5'>
                        <a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$sucursal_id.");' data-toggle='modal' data-target='#editarEstablecimiento' style='cursor: pointer; display:".$display."'>Editar Datos</a>
                        <a class='dropdown-item' data-toggle='modal' data-target='#detallesSucursal-".$sucursal_id."' style='cursor: pointer;'>Ver Detalles</a>
                        <a class='dropdown-item' data-toggle='modal' data-target='#eliminarSucursal' data-id='".$sucursal_id."' style='cursor: pointer; display:".$display."'>Eliminar Datos</a>
                    </div>
                </div>

            <div class='modal fade' id='detallesSucursal-".$sucursal_id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
               <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                     <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalCenterTitle'>".$sucursal_nombre."</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                     </div>
                     <div class='modal-body'>
                       <div class='media'>
                           <input type='hidden' name='mod_id' id='mod_id'>
                           <img id='mod_foto' class='mr-3' src='../img/products/store.png' alt='".$sucursal_nombre."' width='80'>
                           <div class='media-body'>
                               <h5 class='mt-0 font-16'>Nombre:</h5>
                               ".$sucursal_nombre."
                               <h5 class='mt-0 font-16'>Direcci&oacute;n:</h5>
                               ".$sucursal_direccion."
                           </div>
                       </div>
                     </div>
                     <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                     </div>
                  </div>
               </div>
            </div>"
    );
}
$json_string = json_encode($categoriaData);
echo $json_string;