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
$sql = "select * from proveedores where (proveedor_sucursal='$tienda1' or proveedor_sucursal=0) order by proveedor_id desc";
$query = mysqli_query($con,$sql);
$proveedorData = array();

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
    $proveedor_id          = $row['proveedor_id'];
    $proveedor_nombre      = $row['proveedor_nombre'];
    $proveedor_documento = $row['proveedor_documento'];
    $proveedor_tipo = $row['proveedor_tipo'];
    $proveedor_telefono = $row['proveedor_telefono'];
    $proveedor_email = $row['proveedor_email'];
    $proveedor_contacto = $row['proveedor_contacto'];
    $proveedor_sucursal = $row['proveedor_sucursal'];
    $proveedor_direccion = $row['proveedor_direccion'];
    $proveedor_cargo = $row['proveedor_cargo'];
    $proveedor_pais = $row['proveedor_pais'];
    $proveedor_departamento = $row['proveedor_departamento'];
    $proveedor_provincia = $row['proveedor_provincia'];
    $proveedor_distrito = $row['proveedor_distrito'];
    $proveedor_registro = $row['proveedor_registro'];

    $sql_tipo=mysqli_query($con,"select * from sunat_tipocliente where sunat_tipoCliente_id='".$proveedor_tipo."'");
    $rw_tipo=mysqli_fetch_array($sql_tipo);
    $sunat_tipoCliente_nombre=$rw_tipo['sunat_tipoCliente_nombre'];

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $proveedor_registro;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha));       
    $Mes_Anyo = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));

    $fechaActual = date('Y-m-d'); 
    $datetime1 = date_create($proveedor_registro);
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    //$contador->format($differenceFormat);

    if ($proveedor_id == 1) {
        $display = 'none';
    }
    if ($proveedor_id >= 2) {
        $display = '';
    }

    //if ($a[16]==1) {
        $editar = "<li><a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$proveedor_id.");' data-toggle='modal' data-target='#editarProveedor' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/pencil.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Editar Datos</a></li>";
    /*} else {
        $editar = "";
    }*/
    //if ($a[17]==1) {
        $eliminar = "<li><a class='dropdown-item' data-toggle='modal' data-target='#eliminarProveedor' data-id='".$proveedor_id."' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/delete.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Eliminar Datos</a></li>";
        $viewprod= "<li><a class='dropdown-item' data-toggle='modal' data-target='#verprodProveedor' onclick=ver(); data-id='".$proveedor_id."' style='cursor: url(../img/company/cursorH1.png), pointer; display:".$display."'><img src='../assets/images/svg-icon/store.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Ver Productos</a></li>";
    
        /*} else {
        $eliminar = "";
    }*/

    $proveedorData['data'][] = array (
        0 => $a1++,
        1 => $sunat_tipoCliente_nombre,
        2 => $proveedor_documento,
        3 => $proveedor_nombre,
        4 => $proveedor_telefono,
        5 => "<input type='hidden' value='".$proveedor_tipo."' id='cliente_tipo".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_documento."' id='documento_colaborador".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_nombre."' id='cliente_nombre".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_departamento."' id='cliente_departamento".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_provincia."' id='cliente_provincia".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_distrito."' id='cliente_distrito".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_direccion."' id='cliente_direccion".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_pais."' id='cliente_pais".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_telefono."' id='cliente_telefono".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_email."' id='cliente_email".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_contacto."' id='cliente_contacto".$proveedor_id."'>
              <input type='hidden' value='".$proveedor_cargo."' id='cliente_cargo".$proveedor_id."'>

            <div class='btn-group mr-2'>
                <div class='dropdown'>
                    <button class='btn btn-secondary btn-sm dropdown-toggle bg-white' data-toggle='dropdown' type='button' style='cursor: url(../img/company/cursorH1.png), pointer;'>
                        <img src='../assets/images/svg-icon/adjust.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> <i class='dropdown-caret'></i>
                    </button>
                    <div class='dropdown-menu dropdown-menu-right bg-white'>
                        ".$editar."
                        <li><a class='dropdown-item' data-toggle='modal' data-toggle='modal' data-target='#detallesProveedor'

                        data-id='".$proveedor_id."' 
                        data-tipo='".$sunat_tipoCliente_nombre."' 
                        data-documento='".$proveedor_documento."'
                        data-nombre='".$proveedor_nombre."'
                        data-nombre1='".$proveedor_nombre."'
                        data-direccion='".$proveedor_direccion."'
                        data-telefono='".$proveedor_telefono."'
                        data-email='".$proveedor_email."'
                        data-contacto='".$proveedor_contacto."'
                        data-cargo='".$proveedor_cargo."'
                        data-extra='".$proveedor_pais.", ".$proveedor_departamento.", ".$proveedor_provincia.", ".$proveedor_distrito."'
                        data-registro='".$Mes_Anyo." | Hace ".$contador->format($differenceFormat)." d&iacute;as'

                        style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/eye.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Ver Detalles</a></li>
                        ".$viewprod.$eliminar."
                    </div>
                </div>
            </div>"
    );
}
$json_string = json_encode($proveedorData);
echo $json_string;