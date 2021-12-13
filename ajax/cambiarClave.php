<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           	$errors[] = "ID vacío";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
			$errors[] = "Las contrase&ntilde;as no coinciden";
	} 
        else if (
            !empty($_POST['user_password_new'])&&
            !empty($_POST['user_password_repeat'])&&
            ($_POST['user_password_new'] === $_POST['user_password_repeat'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$user_password 	= md5($_POST['user_password_new']); 
        $user_id 		= $_POST['mod_id'];
		$tienda 		= $_SESSION['tienda'];
		
		$sql="update usuarios set usuario_clave='".$user_password."' where usuario_id='".$user_id."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){ ?>
				<script>
						toastr.options = {
					"closeButton":false,
					"progressBar": false
				};
				toastr.success("Contrase&ntilde;a actualizada","Bien hecho!");
				</script>
			<?php } else{ ?>
                <script>
					toastr.options = {
				"closeButton":false,
				"progressBar": false
			};
			toastr.warning("Error desconocido","Oopps!");
				</script>
			<?php }
		} else { ?>
			<script>
					toastr.options = {
				"closeButton":false,
				"progressBar": false
			};
			toastr.error("Error desconocido","Oopps!");
			</script>
		<?php }
                        if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>