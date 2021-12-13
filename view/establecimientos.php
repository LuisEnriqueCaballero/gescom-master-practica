<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
session_start();
$usuario_id = $_SESSION['usuario_id'];
//$status = "Desconectado ahora";
//$sql = mysqli_query($con, "UPDATE usuarios SET usuario_status = '{$status}' WHERE usuario_id={$usuario_id}");
/*if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1){
   header("location: ../view/");
   exit;
}*/
/*if(isset($_SESSION['clave'])) {
	if ($_SESSION['clave']<>'') {
		header('location: ../view/');
	}
}*/
// Destruye todas las variables de la sesión
//$session_name = session_name();
$_SESSION['tienda'] 				= "";
// Para borrar las cookies asociadas a la sesión
// Es necesario hacer una petición http para que el navegador las elimine
/*if (isset($_COOKIE[$session_name])) { ?>
	<script type='text/javascript' language='javascript'>
	document.location.href='../view/';
	</script>
	<?php
        exit();   
}*/