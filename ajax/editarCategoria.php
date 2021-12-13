<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
if (empty($_POST['mod_id'])) {
   	$errors[] = "ID vac&iacute;o";
}
else if (empty($_POST['mod_categoria'])){
	$errors[] = "Debes poner un nombre...";
}
else if (!empty($_POST['mod_categoria']) && !empty($_POST['mod_descripcion'])) {
	$mod_categoria 		= mysqli_real_escape_string($con,(strip_tags($_POST["mod_categoria"],ENT_QUOTES)));
	$mod_descripcion 	= mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
    $categoria_id 		= $_POST['mod_id'];
    $categoria_sucursal = $_SESSION['tienda'];
	$sql1  				= "select * from categorias where categoria_nombre='".$mod_categoria."' and categoria_sucursal='".$categoria_sucursal."'";
	$query_check_marca 	= mysqli_query($con,$sql1);
	$query_check_marca 	= mysqli_num_rows($query_check_marca);
	if ($query_check_marca == 1) { ?>
		<script>
			toastr["info"]("La categor&iacute;a ya est&aacute; registrada", "Precauci&oacute;n!");
		</script>
	<?php } else {
		$sql ="update categorias set
			   categoria_nombre='".$mod_categoria."',
			   categoria_descripcion='".$mod_descripcion."'
			   where categoria_id='".$categoria_id."'";
		$query_new_insert = mysqli_query($con,$sql);
		if ($query_new_insert) { ?>
			<script>
				toastr["success"]("Datos actualizados", "Bien hecho!");
			</script>
		<?php } else { ?>
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
if (isset($messages)) { ?>
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