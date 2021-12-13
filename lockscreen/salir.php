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
   $sexo = "o";
}
if ($sex==2) {
   $sexo = "a";
}
?>
		<div class="sign-in-form">
			<div class="card">
				<div class="card-body">
					<a class="brand text-center d-block m-b-20">
						<img style="height: 150px" src="../img/user/<?php echo $_SESSION['usuario_foto']; ?>" alt="Prizma Technology Logo" />
					</a>
					<h5 class="sign-in-heading text-center"><?php echo $_SESSION['usuario_email']; ?></h5>
					<p class="text-center text-muted">¿Est&aacute;s segur<?php echo $sexo; ?> que quieres salir?</p>
					<button class="btn btn-danger btn-rounded btn-floating btn-block" id="is" onclick="salir();" style="color: #fff;">S&iacute;, salir del sistema</button>
					<button class="btn btn-primary btn-rounded btn-floating btn-block" onclick="cargar_contenido('contenido_principal','lockscreen.php')" style="color: #fff;" id="nn_s">No, desbloquear sesi&oacute;n</button>
				</div>
			</div>
		</div>
<script>
	function salir(){
		$('#is').attr("disabled", true);
		$('#nn_s').attr("disabled", true);
	    $('#is').html('Est&aacute;s saliendo del sistema...');
	    /*swal({
            type: 'success',
            title: 'Nos vemos pronto',
            text: 'Estamos cerrando tu sesión...',
            timer: 500,
            onOpen: () => {
            	swal.showLoading()
            }
        })*/
        toastr.success("Estamos cerrando tu sesi&oacute;n...","Nos vemos pronto");
	    setTimeout('window.location.href ="../view/logoutt.php"; ',2000);
	  }
</script>