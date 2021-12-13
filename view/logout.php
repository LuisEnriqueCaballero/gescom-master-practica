<?php
if($_GET["logout"])
{
session_start();
include("../config/db.php");
include("../config/conexion.php");
$usuario_id = $_SESSION['usuario_id'];
$status = "Desconectado ahora";
$sql = mysqli_query($con, "UPDATE usuarios SET usuario_status = '{$status}' WHERE usuario_id={$usuario_id}");
//remove PHPSESSID from browser
if ( isset( $_COOKIE[session_name()] ) )
setcookie( session_name(), "", time()-3600, "/" );
//clear session from globals
$_SESSION = array();
//clear session from disk
echo session_destroy() ? "Successfully Logged Out" :  "An error Occurred";
exit;
}
?>