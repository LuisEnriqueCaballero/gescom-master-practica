<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/general.php");
include("../config/db.php");
include("../config/conexion.php");
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
	//username and password sent from Form
	$username 	= mysqli_real_escape_string($con,$_POST['username']); 
	$password 	= md5(mysqli_real_escape_string($con,$_POST['password']));
	$result 	= mysqli_query($con,"select * from usuarios where usuario_alias='$username' and usuario_clave='$password'");
	$count 		= mysqli_num_rows($result);
	$row 		= mysqli_fetch_array($result,MYSQLI_ASSOC);
	if ($count == 1) {
		echo $row['usuario_id'];
		$_SESSION['usuario_id'] 		= $row['usuario_id'];

		$_SESSION['usuario_idColaborador'] = $row['usuario_idColaborador'];
		$idColaborador = $_SESSION['usuario_idColaborador'];

		$sql_colaborador 	= mysqli_query($con,"select * from colaboradores where colaborador_id='$idColaborador'");
		$rw_colaborador 	= mysqli_fetch_array($sql_colaborador);
		$colaborador_id 	= $rw_colaborador['colaborador_id'];

		//Datos de la tabla usuarios
		$_SESSION['usuario_alias'] 		= $row['usuario_alias'];
		$_SESSION['usuario_clave'] 		= $row['usuario_clave'];

		//Datos de la tabla colaboradores
		$_SESSION['tienda'] 			= "";
		$_SESSION['usuario_foto'] 		= $rw_colaborador['colaborador_foto'];
		$_SESSION['usuario_sexo'] 		= $rw_colaborador['colaborador_sexo'];
		$_SESSION['usuario_email'] 		= $rw_colaborador['colaborador_email'];
		$_SESSION['usuario_nombres'] 	= $rw_colaborador['colaborador_nombres'];
		$_SESSION['usuario_telefono'] 	= $rw_colaborador['colaborador_telefono'];
		$_SESSION['usuario_domicilio'] 	= $rw_colaborador['colaborador_domicilio'];
		$_SESSION['usuario_documento'] 	= $rw_colaborador['colaborador_documento'];
		$_SESSION['ruta'] 				= $ruta;

		$_SESSION['user_login_status'] 	= 1;

		$date_added			= date("Y-m-d H:i:s");
		$sql_insertLog		="insert into logusuarios (logUsuario_idUsuario, logUsuario_hora, logUsuario_idSucursal) VALUES ('".$row['usuario_id']."','$date_added','".$rw_colaborador['colaborador_sucursal']."')";
		$query_new_insert 	= mysqli_query($con,$sql_insertLog);

		$status 							= "Activo ahora";
            $sql2 								= mysqli_query($con, "UPDATE usuarios SET usuario_status = '{$status}' WHERE usuario_id = {$row['usuario_id']}");
	}
}