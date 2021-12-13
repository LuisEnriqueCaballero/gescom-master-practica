<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
include("../config/db.php");
include("../config/conexion.php");
$tienda = $_SESSION['tienda'];
$sql = "select * from marcas where (marca_sucursal=$tienda or marca_sucursal=0) order by marca_id desc";
$query = mysqli_query($con,$sql);
$categoriaData = array();

$user_id                = $_SESSION['usuario_id'];
//
/*$sql_usuario=mysqli_query($con,"select * from usuarios where usuario_id=$user_id");
$rw_usuario=mysqli_fetch_array($sql_usuario);
$usuario_accesos=$rw_usuario['usuario_accesos'];
//Validamos los accesos
$sql_acceso             = "select * from accesos where acceso_id=$usuario_accesos";
$rw1                    = mysqli_query($con,$sql_acceso);//recuperando el registro
$rs1                    = mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo                 = $rs1["acceso_permiso"];
$a                      = explode(".", $modulo);*/

$a1 = 1;
while ($row = mysqli_fetch_array($query)) {
    $marca_id            = $row['marca_id'];
    $marca_nombre        = $row['marca_nombre'];
    $marca_descripcion   = $row['marca_descripcion'];

    $default = 1;

    if ($marca_id == $default) {
        $display ='none';
    } else {
        $display = '';
    }

    //if ($a[28]==1) {
        $editar = "<li><a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$marca_id.");' data-toggle='modal' data-target='#editarMarca' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/pencil.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Editar Datos</a></li>";
    /*} else {
        $editar = "";
    }*/
    //if ($a[29]==1) {
        $eliminar = "<li><a class='dropdown-item' data-toggle='modal' data-target='#eliminarMarca' data-id='".$marca_id."' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/delete.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Eliminar Datos</a></li>";
    /*} else {
        $eliminar = "";
    }*/

    $categoriaData['data'][] = array (
        0 => $a1++,
        1 => $marca_nombre,
        2 => $marca_descripcion,
        3 => "<input type='hidden' value='".$marca_nombre."' id='nom_marca".$marca_id."'>
            <input type='hidden' value='".$marca_descripcion."' id='desc_marca".$marca_id."'>

            <div class='btn-group mr-2'>
                <div class='dropdown'>
                    <button class='btn btn-secondary btn-sm dropdown-toggle bg-white' data-toggle='dropdown' type='button' style='cursor: url(../img/company/cursorH1.png), pointer;'>
                        <img src='../assets/images/svg-icon/adjust.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> <i class='dropdown-caret'></i>
                    </button>
                    <div class='dropdown-menu dropdown-menu-right bg-white'>
                        ".$editar."
                        <li><a class='dropdown-item' data-toggle='modal' data-target='#detallesMarca-".$marca_id."' style='cursor: pointer;'><img src='../assets/images/svg-icon/eye.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Ver Detalles</a></li>
                        ".$eliminar."
                    </div>
                </div>
            </div>

            <div class='modal fade' id='detallesMarca-".$marca_id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
               <div class='modal-dialog' role='document'>
                  <div class='modal-content bg-white'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><i class='pci-cross pci-circle'></i></button>
                        <h4 class='modal-title'>".$marca_nombre."</h4>
                      </div>
                      <div class='modal-body'>
                        <div class='media'>
                          <div class='media-left'>
                            <img class='media-object img-lg' src='../img/products/brand.png' alt='".$marca_nombre."'>
                          </div>
                          <div class='media-body'>
                            <p class='text-semibold text-main'><strong class='text-primary'>".$marca_nombre."</strong></p>
                            <h5 class='mt-0 font-16'>Nombre:</h5>
                            ".$marca_nombre."
                            <h5 class='mt-0 font-16'>Descripci&oacute;n:</h5>
                            ".$marca_descripcion."
                          </div>
                        </div>
                     </div>
                     <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                     </div>
                  </div>
               </div>
            </div>"
    );
}
$json_string = json_encode($categoriaData);
echo $json_string;