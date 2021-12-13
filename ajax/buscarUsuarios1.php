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
$sql = "select * from usuarios, colaboradores where usuarios.usuario_idColaborador=colaboradores.colaborador_id and colaboradores.colaborador_sucursal='$tienda' order by usuarios.usuario_id desc";
$query = mysqli_query($con,$sql);
$usuarioData = array();
$a = 1;
while ($row = mysqli_fetch_array($query)) {
    $usuario_id             = $row['usuario_id'];
    $usuario_alias          = $row['usuario_alias'];
    $usuario_clave          = $row['usuario_clave'];
    $usuario_registro       = $row['usuario_registro'];
    $usuario_accesos       = $row['usuario_accesos'];

    $colaborador_id         = $row['colaborador_id'];
    $colaborador_nombres    = $row['colaborador_nombres'];
    $colaborador_email      = $row['colaborador_email'];
    $colaborador_domicilio  = $row['colaborador_domicilio'];
    $colaborador_telefono   = $row['colaborador_telefono'];
    $colaborador_foto       = $row['colaborador_foto'];
    $colaborador_cumpleanos = $row['colaborador_cumpleanos'];

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $colaborador_cumpleanos;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha));       
    $Mes_Anyo = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));

    $fecha_nacimiento = $colaborador_cumpleanos;
    $dia_actual = date("Y-m-d");
    $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));

    $fechaActual = date('Y-m-d'); 
    $datetime1 = date_create($usuario_registro);
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    //$contador->format($differenceFormat);

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $usuario_registro;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha));       
    $Mes_Anyo1 = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));


    $usuarioData['data'][] = array (
        0 => $a++,
        1 => "<img src='../img/user/".$colaborador_foto."' class='img-fluid' width='35' alt='".$colaborador_nombres."'>",
        2 => $usuario_alias,
        3 => $colaborador_nombres,
        4 => "<input type='hidden' value='".$usuario_alias."' id='user_name".$usuario_id."'>
              <input type='hidden' value='".$colaborador_id."' id='colaborador_id".$usuario_id."'>
              <input type='hidden' value='".$usuario_accesos."' id='usuario_accesos".$usuario_id."'>

            <div class='btn-group dropleft dropup'>
                    <button class='btn btn-primary btn-outline dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='feather icon-settings'></i></button>
                    <div class='dropdown-menu' aria-labelledby='CustomdropdownMenuButton5'>
                        <a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$usuario_id.");' data-toggle='modal' data-target='#editarUsuario' style='cursor: pointer;'>Editar Datos</a>
                        <a class='dropdown-item' data-toggle='modal' data-target='#detallesUsuario-".$usuario_id."' style='cursor: pointer;'>Ver Detalles</a>
                        <a class='dropdown-item' data-toggle='modal' data-target='#eliminarUsuario' data-id='".$usuario_id."' style='cursor: pointer;'>Eliminar Datos</a>
                    </div>
                </div>

            <div class='modal fade' id='detallesUsuario-".$usuario_id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
               <div class='modal-dialog modal-lg' role='document'>
                  <div class='modal-content'>
                     <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalCenterTitle'>".$colaborador_nombres."</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                     </div>
                     <div class='modal-body'>
                       <div class='row align-items-center'>
                          <div class='col-12 col-md-4'>
                              <img src='../img/user/".$colaborador_foto."' class='img-fluid' alt='".$colaborador_nombres."'>
                          </div>
                          <div class='col-12 col-md-8'>
                              <h5 class='card-title mb-1'>".$colaborador_nombres."</h5>
                              <p class='mb-0 font-12 font-italic'>".$colaborador_domicilio."</p><hr>
                              <b>Usuario: </b>".$usuario_alias."<br>
                              <b>Tel&eacute;fono:</b> ".$colaborador_telefono."<br>
                              <b>E-Mail:</b> ".$colaborador_email."<br>
                              <b>F. Nacimiento:</b> ".$Mes_Anyo." | ".$edad_diff->format('%y')." a&ntilde;os de edad<br>
                              <b>F. Registro:</b> ".$Mes_Anyo1." | Hace ".$contador->format($differenceFormat)." d&iacute;as
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
$json_string = json_encode($usuarioData);
echo $json_string;