<!---------------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
----------------------------------->
<?php
//Verificamos si el usuario esta logueado, si no esta logueado lo redirecciona al login, si ya esta logueado se queda en el panel
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
   header("location: ../login/");
   exit;
}
//requerimos el archivo de configuracion
require_once "../config/general.php"; //Contiene las variables generales
//Nos conectamos a la base de datos
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos

$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "Masculino";
}
if ($sex==2) {
   $sexo = "Femenino";
}
?>
		<form class="sign-in-form" id="lg1" action="" method="post" autocomplete="off">
			<div class="card">
				<div class="card-body">
					<a class="brand text-center d-block m-b-20">
						<img style="height: 150px" src="../img/user/<?php echo $_SESSION['usuario_foto']; ?>" alt="Prizma Technology Logo" />
					</a>
					<h5 class="sign-in-heading text-center m-b-20"><?php echo $_SESSION['usuario_email']; ?></h5>
					<div class="form-group" style="display: none;">
						<label for="username" class="sr-only">Usuario o Correo electr&oacute;nico</label>
						<input type="text" id="username" name="username" class="form-control" placeholder="Usuario o Correo electr&oacute;nico" onKeyUp="this.value=this.value.toUpperCase();" required="" value="<?php echo $_SESSION['usuario_email']; ?>">
					</div>

					<div class="form-group">
						<label for="password" class="sr-only">Contrase&ntilde;a</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" onKeyUp="this.value=this.value.toUpperCase();" required="">
					</div>
					<button class="btn btn-primary btn-rounded btn-floating btn-block" type="submit" id="login">Desbloquear Sesi&oacute;n</button>
					<p id="is" class="text-muted m-t-25 m-b-0 p-0" style="text-align: center;">¿No eres t&uacute;? <a onclick="cargar_contenido('contenido_principal','salir.php')" style="cursor: pointer; color: #3c8dbc;">Haz click aqu&iacute; para salir</a></p>
				</div>
			</div>
		</form>
<script src="../js/lock1.js"></script>
<script>
	$('#password').focus();
</script>