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
if(isset($_POST['documento_colaborador'])) {
	//Recogemos los datos del documento enviado
	$username 	= mysqli_real_escape_string($con,$_POST['documento_colaborador']); 
	$result 	= mysqli_query($con,"select * from colaboradores where colaborador_documento='$username'");
	$count 		= mysqli_num_rows($result);
	$row 		= mysqli_fetch_array($result,MYSQLI_ASSOC);
	//Datos del colaborador
	$estado 					= $row['colaborador_estado'];
	$asistencia_idColaborador 	= $row['colaborador_id'];
	$asistencia_idSucursal		= $row['colaborador_sucursal'];
	$asistencia_ingreso 		= date('Y-m-d H:i:s');
	$asistencia_salida 			= '0000-00-00 00-00-00';
	//Validacion de asistencia por fecha
	$hoy   		= date('Y-m-d');
	//ruc sent from Form
	$sql1 = "select * from asistencia where asistencia_idColaborador='".$asistencia_idColaborador."' and asistencia_idSucursal='".$asistencia_idSucursal."' and (DATE_FORMAT(asistencia_ingreso, '%Y-%m-%d')='$hoy')";
	$query_check_marca = mysqli_query($con,$sql1);
	$query_check_marca=mysqli_num_rows($query_check_marca);
	if ($query_check_marca != 1) {
		if ($count == 1) {
			/*if ($estado == 0) {
				echo "1";
			}
			if ($estado != 0) {*/
				echo "2";
	            $sql2 	= mysqli_query($con, "insert into asistencia (asistencia_idColaborador, asistencia_idSucursal, asistencia_idVariable, asistencia_ingreso, asistencia_salida) values ('$asistencia_idColaborador','$asistencia_idSucursal','0','$asistencia_ingreso','$asistencia_salida')");
			//}
		} else {
			echo "3";
		}
	} else {
		echo "4";
	}
}