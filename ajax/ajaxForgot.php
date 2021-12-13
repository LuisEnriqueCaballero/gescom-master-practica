<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../view/funciones/funciones.php";
	
	if (empty($_POST['txt_email'])) {
           //$errors[] = "Correo vacio";
		?>
		<script>
			toastr["warning"]("Correo electr&oacute;nico vac&iacute;o", "Aviso!");
		</script>
        <?php }
        else if (
			!empty($_POST['txt_email'])
		){
		
		$user_email	= $_POST['txt_email'];

		$pass 			= strtoupper(generar_clave(10));
		$user_password 	= md5($pass);
		
		$sql_colaborador = "select * from colaboradores where colaborador_email='".$user_email."'";
		$query_colaborador = mysqli_query($con,$sql_colaborador);
		$row_colaborador= mysqli_fetch_array($query_colaborador);
		$colaborador_id = $row_colaborador['colaborador_id'];

		$sql_usuario = "select * from usuarios where usuario_idColaborador='".$colaborador_id."'";
		$query_usuario = mysqli_query($con,$sql_usuario);
		$row_usuario= mysqli_fetch_array($query_usuario);
		$usuario_alias = $row_usuario['usuario_alias'];
		$query_usuario=mysqli_num_rows($query_usuario);
		if ($query_usuario == 0) { ?>
			<script>
				toastr["error"]("No se encontr&oacute; el correo electr&oacute;nico", "Oopps!");
			</script>
		<?php }else{
			$sql="update usuarios set usuario_clave='".$user_password."' where usuario_idColaborador='".$colaborador_id."'";
			$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){ ?>
				<script>
					toastr["success"]("Tu nueva contrase&ntilde;a fue enviada por correo", "Bien hecho!");
				</script>
			<?php
			include "../mail/passw/sendemail.php";//Mando a llamar la funcion que se encarga de enviar el correo electronico
			include "../config/general.php";
			//datos de la empresa
			$sql_empresa=mysqli_query($con,"select * from datosempresa where datosEmpresa_id='1'");
			$rw_empresa=mysqli_fetch_array($sql_empresa);
			$datosEmpresa_nombre=$rw_empresa['datosEmpresa_nombre'];
			$datosEmpresa_telefono=$rw_empresa['datosEmpresa_telefono'];
			$datosEmpresa_correo=$rw_empresa['datosEmpresa_correo'];

		   /*Configuracion de variables para enviar el correo*/
			$mail_username=$usuario;//Correo electronico saliente ejemplo: tucorreo@gmail.com
			$mail_userpassword=$clave;//Tu contrase単a de gmail
		   	$mail_addAddress = $user_email;
		   	/*Inicio captura de datos enviados por $_POST para enviar el correo */
			$mail_setFromEmail=$emisor;//tu correo de gmail
			$mail_setFromName=$datosEmpresa_nombre;//nombre

			$nomempresa=$datosEmpresa_nombre;
			$telefono=$datosEmpresa_telefono;
			$correo=$datosEmpresa_correo;

			$new_password = $pass;

			$template="../mail/passw/email_template.html";

			$url1 = $ruta.'/img/company/logo.png';
			$url2 = $ruta.'/mail/password/images/facebook@2x.png';
			$url3 = $ruta.'/mail/password/images/twitter@2x.png';
			$url4 = $ruta.'/mail/password/images/divider.png';
			$url5 = $ruta.'/mail/password/images/rounder-up.png';
			$url6 = $ruta.'/mail/password/images/rounder-dwn.png';

			$sistema = $sistema_name;
			$sistema_ruta = $ruta;

	       	$mail_subject = 'Nueva contraseña | '.$datosEmpresa_nombre;
	       	$txt_message = "Por favor usa esta nueva contrase&ntilde;a para ingresar al Sistema de Facturaci&oacute;n Electr&oacute;nica.";
	       	sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$usuario_alias,$nomempresa,$url1,$url2,$url3,$url4,$url5,$url6,$telefono,$correo,$new_password,$txt_message,$sistema,$sistema_ruta,$mail_subject,$template);//Enviar el mensaje
		} else{ ?>
				<script>
					toastr.options = {
					"closeButton":false,
					"progressBar": false
					};
					toastr.warning("No se encontr&oacute; el correo","Precauci&oacute;n");
				</script>
			<?php }
		}
		}else { ?>
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