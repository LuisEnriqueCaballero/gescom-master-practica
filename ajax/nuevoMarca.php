<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
	if (empty($_POST['nom_marca'])) {
           $errors[] = "Debes poner un nombre...";
        } else if (empty($_POST['desc_marca'])){
			$errors[] = "Debes poner una descripci&oacute;n...";
		} else if (!empty($_POST['nom_marca']) && !empty($_POST['desc_marca'])) {
		
		$nom_marca=mysqli_real_escape_string($con,(strip_tags($_POST["nom_marca"],ENT_QUOTES)));
		$desc_marca=mysqli_real_escape_string($con,(strip_tags($_POST["desc_marca"],ENT_QUOTES)));
		$tienda=$_SESSION['tienda'];
		
		$sql1 = "select * from marcas where marca_nombre='".$nom_marca."' and marca_sucursal='".$tienda."'";
		$query_check_marca = mysqli_query($con,$sql1);
		$query_check_marca=mysqli_num_rows($query_check_marca);
		if ($query_check_marca == 1) { ?>
			<script>
				toastr["info"]("La marca ya est&aacute; registrada", "Precauci&oacute;n!");
			</script>
		<?php }else{
			$sql="insert into marcas (marca_nombre, marca_descripcion, marca_sucursal) values ('$nom_marca','$desc_marca','$tienda')";
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