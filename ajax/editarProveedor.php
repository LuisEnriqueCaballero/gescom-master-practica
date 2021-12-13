<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
if (empty($_POST['mod_tipo'])){
    $errors[] = "Selecciona un tipo de documento";
}
elseif ( !empty($_POST['mod_idprov'])) {
    $mod_tipo           = intval($_POST["mod_tipo"]);
    $mod_documento      = mysqli_real_escape_string($con,(strip_tags($_POST["mod_documento"],ENT_QUOTES)));
    $mod_nombre         = mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
    $mod_departamento   = mysqli_real_escape_string($con,(strip_tags($_POST["mod_departamento"],ENT_QUOTES)));
    $mod_provincia      = mysqli_real_escape_string($con,(strip_tags($_POST["mod_provincia"],ENT_QUOTES)));
    $mod_distrito       = mysqli_real_escape_string($con,(strip_tags($_POST["mod_distrito"],ENT_QUOTES)));
    $mod_domicilio      = mysqli_real_escape_string($con,(strip_tags($_POST["mod_domicilio"],ENT_QUOTES)));
    $mod_pais           = mysqli_real_escape_string($con,(strip_tags($_POST["mod_pais"],ENT_QUOTES)));
    $mod_telefono       = mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
    $mod_email          = mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
    $mod_contacto       = mysqli_real_escape_string($con,(strip_tags($_POST["mod_contacto"],ENT_QUOTES)));
    $mod_cargo          = mysqli_real_escape_string($con,(strip_tags($_POST["mod_cargo"],ENT_QUOTES)));
    $mod_id             = intval($_POST["mod_idprov"]);

    $sql = "update proveedores set 
            proveedor_nombre='".$mod_nombre."',
            proveedor_telefono='".$mod_telefono."',
            proveedor_email='".$mod_email."',
            proveedor_direccion='".$mod_domicilio."',
            proveedor_tipo='".$mod_tipo."',
            proveedor_documento='".$mod_documento."',
            proveedor_pais='".$mod_pais."',
            proveedor_departamento='".$mod_departamento."',
            proveedor_provincia='".$mod_provincia."',
            proveedor_distrito='".$mod_distrito."',
            proveedor_contacto='".$mod_contacto."',
            proveedor_cargo='".$mod_cargo."'
            where proveedor_id='".$mod_id."'";
    $query_update = mysqli_query($con,$sql);
    if ($query_update) { ?>
        <script>
        toastr["success"]("Datos actualizados", "Bien hecho!");
        </script>
    <?php }
    else { ?>
        <script>
        toastr["warning"]("<?php echo mysqli_error($con); ?>", "Aviso!");
        </script>
    <?php }
} else { ?>
    <script>
    toastr["error"]("Error desconocido", "Oopss!");
    </script>
<?php }
if (isset($errors)) { ?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong> 
		<?php
			foreach ($errors as $error) {
				echo $error;
			}
		?>
	</div>
<?php }
if (isset($messages)){ ?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
			foreach ($messages as $message) {
				echo $message;
			}
		?>
	</div>
<?php } ?>