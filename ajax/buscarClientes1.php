<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
$tienda1=$_SESSION['tienda'];
$sql = "select * from clientes where (cliente_sucursal='$tienda1' or cliente_sucursal=0) order by cliente_id desc";
$query = mysqli_query($con,$sql);
$clienteData = array();

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
    $cliente_id          = $row['cliente_id'];
    $cliente_nombre      = $row['cliente_nombre'];
    $cliente_documento = $row['cliente_documento'];
    $cliente_tipo = $row['cliente_tipo'];
    $cliente_telefono = $row['cliente_telefono'];
    $cliente_email = $row['cliente_email'];
    $cliente_contacto = $row['cliente_contacto'];

    $cliente_sucursal = $row['cliente_sucursal'];
    $cliente_direccion = $row['cliente_direccion'];
    $cliente_cargo = $row['cliente_cargo'];
    $cliente_pais = $row['cliente_pais'];
    $cliente_departamento = $row['cliente_departamento'];
    $cliente_provincia = $row['cliente_provincia'];
    $cliente_distrito = $row['cliente_distrito'];
    $cliente_registro = $row['cliente_registro'];

    $sql_tipo=mysqli_query($con,"select * from sunat_tipocliente where sunat_tipoCliente_id='".$cliente_tipo."'");
    $rw_tipo=mysqli_fetch_array($sql_tipo);
    $sunat_tipoCliente_nombre=$rw_tipo['sunat_tipoCliente_nombre'];

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $cliente_registro;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha));       
    $Mes_Anyo = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));

    $fechaActual = date('Y-m-d'); 
    $datetime1 = date_create($cliente_registro);
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    //$contador->format($differenceFormat);

    if ($cliente_id == 1) {
        $display = 'none';
    }
    if ($cliente_id >= 2) {
        $display = '';
    }

    //if ($a[12]==1) {
        $editar = "<li><a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$cliente_id.");' data-toggle='modal' data-target='#editarCliente' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/pencil.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Editar Datos</a></li>";
    /*} else {
        $editar = "";
    }*/
    //if ($a[13]==1) {
        $eliminar = "<li><a class='dropdown-item' data-toggle='modal' data-target='#eliminarCliente' data-id='".$cliente_id."' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/delete.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Eliminar Datos</a></li>";
    /*} else {
        $eliminar = "";
    }*/

    $clienteData['data'][] = array (
        0 => $a1++,
        1 => $sunat_tipoCliente_nombre,
        2 => $cliente_documento,
        3 => $cliente_nombre,
        4 => $cliente_telefono,
        5 => "<input type='hidden' value='".$cliente_tipo."' id='cliente_tipo".$cliente_id."'>
              <input type='hidden' value='".$cliente_documento."' id='documento_colaborador".$cliente_id."'>
              <input type='hidden' value='".$cliente_nombre."' id='cliente_nombre".$cliente_id."'>
              <input type='hidden' value='".$cliente_departamento."' id='cliente_departamento".$cliente_id."'>
              <input type='hidden' value='".$cliente_provincia."' id='cliente_provincia".$cliente_id."'>
              <input type='hidden' value='".$cliente_distrito."' id='cliente_distrito".$cliente_id."'>
              <input type='hidden' value='".$cliente_direccion."' id='cliente_direccion".$cliente_id."'>
              <input type='hidden' value='".$cliente_pais."' id='cliente_pais".$cliente_id."'>
              <input type='hidden' value='".$cliente_telefono."' id='cliente_telefono".$cliente_id."'>
              <input type='hidden' value='".$cliente_email."' id='cliente_email".$cliente_id."'>
              <input type='hidden' value='".$cliente_contacto."' id='cliente_contacto".$cliente_id."'>
              <input type='hidden' value='".$cliente_cargo."' id='cliente_cargo".$cliente_id."'>
              <input type='hidden' value='".$cliente_id."' id='cliente_id2".$cliente_id."'>

                <div class='btn-group'>
                    <div class='dropdown'>
                        <button class='btn btn-secondary btn-sm dropdown-toggle bg-white' data-toggle='dropdown' type='button' style='cursor: url(../img/company/cursorH1.png), pointer;'>
                            <img src='../assets/images/svg-icon/adjust.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> <i class='dropdown-caret'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-right bg-white'>
                            ".$editar."
                            
                            <li><a class='dropdown-item' data-toggle='modal' data-toggle='modal' data-target='#detallesCliente'

                            data-id='".$cliente_id."' 
                            data-tipo='".$sunat_tipoCliente_nombre."' 
                            data-documento='".$cliente_documento."'
                            data-nombre='".$cliente_nombre."'
                            data-nombre1='".$cliente_nombre."'
                            data-direccion='".$cliente_direccion."'
                            data-telefono='".$cliente_telefono."'
                            data-email='".$cliente_email."'
                            data-contacto='".$cliente_contacto."'
                            data-cargo='".$cliente_cargo."'
                            data-extra='".$cliente_pais.", ".$cliente_departamento.", ".$cliente_provincia.", ".$cliente_distrito."'
                            data-registro='".$Mes_Anyo." | Hace ".$contador->format($differenceFormat)." d&iacute;as'

                            style='cursor: url(../img/company/cursorH1.png), pointer;' ><img src='../assets/images/svg-icon/eye.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Ver Detalles</a></li>
                            ".$eliminar."
                        </ul>
                    </div>
                </div>"
    );
}
$json_string = json_encode($clienteData);
echo $json_string;