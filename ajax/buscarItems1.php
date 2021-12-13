<?php
session_start();
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
$tienda1=$_SESSION['tienda'];

$almacen = $_SESSION['almacen'];

$sql = "select * from productos where producto_idSucursal=$almacen order by producto_id desc";
$query = mysqli_query($con,$sql);
$productoData = array();
//Sesion de la empresa logueada
$empresa = 1;
//Datos de la empresa activa
$sql_empresa=mysqli_query($con,"select * from datosempresa where datosEmpresa_id=$empresa");
$rw_tienda=mysqli_fetch_array($sql_empresa);
$datosEmpresa_ruc=$rw_tienda['datosEmpresa_ruc'];
//
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
    $producto_id           = $row['producto_id'];
    $producto_codigo       = $row['producto_codigo'];
    $producto_nombre       = $row['producto_nombre'];
    $producto_precio       = $row['producto_precio'];
    $producto_idMarca      = $row['producto_idMarca'];
    $producto_idCategoria  = $row['producto_idCategoria'];
    $producto_codigoBarras = $row['producto_codigoBarras'];
    $producto_stock        = $row['producto_stock'];
    $producto_foto         = $row['producto_foto'];
    $producto_afectacion   = $row['producto_afectacion'];
    $producto_descripcion   = $row['producto_descripcion'];
    $producto_idUnidadMedida   = $row['producto_idUnidadMedida'];
    $producto_fechaVencimiento   = $row['producto_fechaVencimiento'];
    $producto_idProveedor   = $row['producto_idProveedor'];
    $producto_monVenta   = $row['producto_monVenta'];
    $producto_costo   = $row['producto_costo'];
    $producto_minimo   = $row['producto_minimo'];
    $producto_icbper   = $row['producto_icbper'];

    setlocale(LC_TIME, "spanish");
    $mi_fecha = $producto_fechaVencimiento;
    $mi_fecha = str_replace("/", "-", $mi_fecha);     
    $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha)); 

    if ($producto_fechaVencimiento == '0000-00-00') {
      $Mes_Anyo = '----';
      $producto_fechaVencimiento1 = "1";
    } else {
      $Mes_Anyo = strftime("%d de %B de %Y", strtotime($Nueva_Fecha));
      $producto_fechaVencimiento1 = "2";
    }

    

    $sql_categoria=mysqli_query($con,"select * from categorias where categoria_id='".$producto_idCategoria."'");
    $rw_categoria=mysqli_fetch_array($sql_categoria);
    $categoria_nombre=$rw_categoria['categoria_nombre'];

    $sql_marca=mysqli_query($con,"select * from marcas where marca_id='".$producto_idMarca."'");
    $rw_marca=mysqli_fetch_array($sql_marca);
    $marca_nombre=$rw_marca['marca_nombre'];

    $sql_tipo_afectacion=mysqli_query($con,"select * from tipo_afectacion where tipoafectacion_id='".$producto_afectacion."'");
    $rw_tipo_afectacion=mysqli_fetch_array($sql_tipo_afectacion);
    $tipoafectacion_nombre=$rw_tipo_afectacion['tipoafectacion_nombre'];
    $tipoafectacion_id=$rw_tipo_afectacion['tipoafectacion_id'];

    if ($tipoafectacion_id <= 8) {
      $igv = 'S&Iacute;';
    }
    if ($tipoafectacion_id >= 9) {
      $igv = 'NO';
    }

    if ($producto_monVenta == 115) {
      $moneda = "S/ ";
    }
    if ($producto_monVenta == 151) {
      $moneda = "$ ";
    }

    //if ($a[36]==1) {
        $editar = "<li><a class='dropdown-item' data-toggle='modal' onclick='obtener_datos(".$producto_id.");' data-target='#editarItem' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/pencil.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Editar Datos</a></li>";
    /*} else {
        $editar = "";
    }*/
    //if ($a[37]==1) {
        $eliminar = "<li><a class='dropdown-item' data-toggle='modal' data-target='#eliminarItem' data-id='".$producto_id."' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/delete.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Eliminar Datos</a></li>";
    /*} else {
        $eliminar = "";
    }*/

    //if ($a[38]==1) {
        $cFoto = "<li><a class='dropdown-item' data-toggle='modal' onclick='carga_img(".$producto_id.");' data-target='#imgItem' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/pictures.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Cambiar Foto</a></li>";
    /*} else {
        $cFoto = "";
    }*/

    //if ($a[39]==1) {
        $cEsp = "<li><a class='dropdown-item' data-toggle='modal' onclick='carga_esp(".$producto_id.");' data-target='#especificacionesItem' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/pdf2.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Cargar Especificaciones</a></li>";
    /*} else {
        $cEsp = "";
    }*/

    //if ($a[40]==1) {
        $cFt = "<li><a class='dropdown-item' data-toggle='modal' onclick='carga_fic(".$producto_id.");' data-target='#fichaItem' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/pdf2.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Cargar Ficha T&eacute;cnica</a></li>";
    /*} else {
        $cFt = "";
    }*/

    if ($producto_foto == 'nuevo.jpg') {
      $rutaFoto = "<img src='../img/products/nuevo.jpg' class='img-fluid' width='35' alt='".$producto_codigo."'>";
      $rutaFoto1 = "<img class='media-object img-lg' src='../img/products/nuevo.jpg' alt='".$producto_nombre."'>";
    }
    if ($producto_foto != 'nuevo.jpg') {
      $rutaFoto = "<img src='../img/products/".$datosEmpresa_ruc."/".$producto_foto."' class='img-fluid' width='35' alt='".$producto_codigo."'>";
      $rutaFoto1 = "<img class='media-object img-lg' src='../img/products/".$datosEmpresa_ruc."/".$producto_foto."' alt='".$producto_nombre."'>";
    }

    $productoData['data'][] = array (
        0 => $a1++,
        1 => $rutaFoto,
        2 => $producto_codigo,
        3 => $producto_codigoBarras,
        4 => $producto_nombre,
        5 => $producto_stock,
        6 => $moneda."".number_format($producto_precio,2),
        7 => $igv,
        8 => "<input type='hidden' value='".$producto_codigoBarras."' id='producto_codigoBarras".$producto_id."'>
              <input type='hidden' value='".$producto_nombre."' id='producto_nombre".$producto_id."'>
              <input type='hidden' value='".$producto_descripcion."' id='producto_descripcion".$producto_id."'>
              <input type='hidden' value='".$producto_idCategoria."' id='producto_idCategoria".$producto_id."'>
              <input type='hidden' value='".$producto_idMarca."' id='producto_idMarca".$producto_id."'>
              <input type='hidden' value='".$producto_idUnidadMedida."' id='producto_idUnidadMedida".$producto_id."'>
              <input type='hidden' value='".$producto_idProveedor."' id='producto_idProveedor".$producto_id."'>
              <input type='hidden' value='".$producto_afectacion."' id='producto_afectacion".$producto_id."'>
              <input type='hidden' value='".$producto_monVenta."' id='producto_monVenta".$producto_id."'>
              <input type='hidden' value='".$producto_costo."' id='producto_costo".$producto_id."'>
              <input type='hidden' value='".$producto_precio."' id='producto_precio".$producto_id."'>
              <input type='hidden' value='".$producto_stock."' id='producto_stock".$producto_id."'>
              <input type='hidden' value='".$producto_minimo."' id='producto_minimo".$producto_id."'>
              <input type='hidden' value='".$producto_icbper."' id='producto_icbper".$producto_id."'>
              <input type='hidden' value='".$producto_codigo."' id='producto_codigo".$producto_id."'>
              <input type='hidden' value='".$producto_fechaVencimiento1."' id='producto_fechaVencimiento1".$producto_id."'>

            <div class='btn-group mr-2'>
                <div class='dropdown'>
                    <button class='btn btn-secondary btn-sm dropdown-toggle bg-white' data-toggle='dropdown' type='button' style='cursor: url(../img/company/cursorH1.png), pointer;'>
                        <img src='../assets/images/svg-icon/adjust.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> <i class='dropdown-caret'></i>
                    </button>
                    <div class='dropdown-menu dropdown-menu-right bg-white'>
                        ".$editar."
                        <li><a class='dropdown-item' data-toggle='modal' data-target='#detallesColaborador-".$producto_id."' style='cursor: url(../img/company/cursorH1.png), pointer;'><img src='../assets/images/svg-icon/eye.svg' class='img-fluid' alt='settings' style='width: 15px; height: 15px;'> Ver Detalles</a></li>
                        ".$cFoto."
                        ".$cEsp."
                        ".$cFt."
                        ".$eliminar."
                    </div>
                </div>
            </div>

            

            <div class='modal fade' id='detallesColaborador-".$producto_id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
               <div class='modal-dialog' role='document'>
                  <div class='modal-content bg-white'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><i class='pci-cross pci-circle'></i></button>
                        <h4 class='modal-title'>".$producto_nombre."</h4>
                      </div>
                      <div class='modal-body'>
                        <div class='media'>
                          <div class='media-left'>
                            ".$rutaFoto1."
                          </div>
                          <div class='media-body'>
                              <p class='mb-0 font-12 font-italic'>".$producto_descripcion."</p>
                              <b>Afectaci&oacute;n:</b> ".$tipoafectacion_nombre."<br>
                              <b>C&oacute;digo SUNAT:</b> ".$producto_codigo."<br>
                              <b>C&oacute;digo Barras:</b> ".$producto_codigoBarras."<br>
                              <b>Categor&iacute;a:</b> ".$categoria_nombre."<br>
                              <b>Marca:</b> ".$marca_nombre."<br>
                              <b>F. Vencimiento:</b> ".$Mes_Anyo."<br>
                              <b>Precio:</b> ".$producto_precio."<br>
                              <b>Stock:</b> ".$producto_stock."<br>
                              <b>IGV:</b> ".$igv."
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
$json_string = json_encode($productoData);
echo $json_string;