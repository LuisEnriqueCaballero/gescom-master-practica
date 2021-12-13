<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
if (empty($_POST['cliente_tipo'])){
    $errors[] = "Selecciona un tipo de documento";
}
elseif ( !empty($_POST['cliente_tipo'])) {
        
    $cliente_tipo           = intval($_POST["cliente_tipo"]);
    $cliente_departamento   = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_departamento"],ENT_QUOTES)));
    $cliente_documento      = mysqli_real_escape_string($con,(strip_tags($_POST["documento_colaborador"],ENT_QUOTES)));
    $cliente_nombre         = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_nombre"],ENT_QUOTES)));
    $cliente_provincia      = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_provincia"],ENT_QUOTES)));
    $cliente_distrito       = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_distrito"],ENT_QUOTES)));
    $cliente_direccion      = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_direccion"],ENT_QUOTES)));
    $cliente_pais           = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_pais"],ENT_QUOTES)));
    $cliente_telefono       = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_telefono"],ENT_QUOTES)));
    $cliente_email          = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_email"],ENT_QUOTES)));
    $cliente_contacto       = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_contacto"],ENT_QUOTES)));
    $cliente_cargo          = mysqli_real_escape_string($con,(strip_tags($_POST["cliente_cargo"],ENT_QUOTES)));
    $cliente_registro       = date('Y-m-d');
    //$cliente_sucursal       = 1;
    $cliente_ciudad         = '-';
    $cliente_sucursal       = $_SESSION['tienda'];
        
    $sql1 = "select * from proveedores where proveedor_documento='".$cliente_documento."' and proveedor_sucursal='".$cliente_sucursal."'";
    $query_check_marca = mysqli_query($con,$sql1);
    $query_check_marca=mysqli_num_rows($query_check_marca);

    if ($query_check_marca == 1) { ?>
        <script>
            toastr["info"]("El documento ya est&aacute; registrado", "Aviso!");
        </script>
    <?php }else{
         $sql = "insert into proveedores (
            proveedor_nombre,
            proveedor_telefono,
            proveedor_email,
            proveedor_direccion,
            proveedor_tipo,
            proveedor_documento,
            proveedor_pais,
            proveedor_departamento,
            proveedor_provincia,
            proveedor_distrito,
            proveedor_sucursal,
            proveedor_contacto,
            proveedor_cargo,
            proveedor_ciudad,
            proveedor_registro)
            values (
            '$cliente_nombre',
            '$cliente_telefono',
            '$cliente_email',
            '$cliente_direccion',
            '$cliente_tipo',
            '$cliente_documento',
            '$cliente_pais',
            '$cliente_departamento',
            '$cliente_provincia',
            '$cliente_distrito',
            '$cliente_sucursal',
            '$cliente_contacto',
            '$cliente_cargo',
            '$cliente_ciudad',
            '$cliente_registro'
            )";
        $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){ ?>
            <script>
                toastr["success"]("Datos registrados", "Bien hecho!");
            </script>
        <?php } else{ ?>
            <script>
                toastr["warning"]("<?php echo mysqli_error($con); ?>", "Aviso!");
            </script>
        <?php }
    }
    }else { ?>
        <script>
            toastr["error"]("Error desconocido", "Oopss!");
        </script>
<?php }
    
    if (isset($errors)){
        
        ?>
        <div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert">
        <?php
        foreach ($errors as $error) {
                echo $error;
            }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="la la-close"></span>
        </button>
        </div>
        <?php
        }
        if (isset($messages)){
            
            ?>
        <div class="alert alert-success alert-outline alert-dismissible fade show" role="alert">
        <?php
        foreach ($messages as $message) {
                echo $message;
            }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="la la-close"></span>
        </button>
        </div>
            <?php
        }

?>