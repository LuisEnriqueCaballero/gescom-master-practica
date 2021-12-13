<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//Verificamos si el usuario esta logueado, si no esta logueado lo redirecciona al login, si ya esta logueado se queda en el panel
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
	header("location: ../login/");
exit;
}
//Nos conectamos a la base de datos
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
//Datos para la lista de usuario
$usuario_actual    	= $_SESSION['usuario_id'];
$tienda            	= $_SESSION['tienda'];
$consulta_usuarios 	= "select * from usuarios where usuario_id<>'$usuario_actual' and usuario_sucursal='$tienda' and usuario_activoChat=1";
$resultado_usuarios = mysqli_query($con, $consulta_usuarios);
//Contamos los registros
$count_query       = mysqli_query($con, "select count(*) as numrows from usuarios where usuario_id<>'$usuario_actual' and usuario_sucursal='$tienda' and usuario_activoChat=1");
$row               = mysqli_fetch_array($count_query);
$numrows           = $row['numrows'];
//Si hay registros mostramos
if ($numrows>0) {
  while($registros_usuarios = mysqli_fetch_array($resultado_usuarios)){
  	$usuario_id=$registros_usuarios['usuario_id'];
	$usuario_nombres=$registros_usuarios['usuario_nombres'];
	$usuario_alias=$registros_usuarios['usuario_alias'];
	$usuario_activoChat=$registros_usuarios['usuario_activoChat'];
	$usuario_foto=$registros_usuarios['usuario_foto'];

	$usuario_log= mysqli_query($con, "select * from logusuarios where logUsuario_idUsuario=$usuario_id");
    $row6= mysqli_fetch_array($usuario_log);
    $logUsuario_hora = $row6['logUsuario_hora'];
?>
<div class="timeline-list  timeline-border timeline-success">
	<div class="timeline-info">
		<div class="d-inline-block"><?php echo $usuario_alias; ?></div>
		<small class="float-right text-muted"><?php echo $logUsuario_hora; ?></small>
	</div>
</div>

<?php
  }
} else { //Caso contrario muestra un mensaje ?>
<br>
<div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert" style="text-align: center;">
    <img src="../img/company/pacman.gif">
    <br>
    <strong>Oopss!</strong> No se han encontrado usuarios conectados actualmente.
</div>
<?php } ?>