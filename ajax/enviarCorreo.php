<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
//include 'is_logged.php';
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../view/funciones/funciones.php";
session_start();
	
if (empty($_POST['id_clienteMail'])) {
    $errors[] = "Correo vacio"; ?>
	<script>
		//toastr["warning"]("Correo electr&oacute;nico vac&iacute;o", "Aviso!");
		$.niftyNoty({
            type: 'danger',
            icon : 'pli-exclamation icon-2x',
            message : '<strong>Oopps!</strong><br> Correo electr&oacute;nico vac&iacute;o. ',
            container : 'floating',
            timer : 5000
        });
	</script>
    <?php }
else if (!empty($_POST['id_clienteMail'])) {

	$empresa    = $_SESSION['datosEmpresa_id'];
	$tienda     = $_SESSION['tienda'];
	
	$id_factura	= $_POST['id_clienteMail'];
	//Datos de la factura
	$sql_factura 		 = "select * from plantilla_mail where plantilla_idSucursal='".$tienda."'";
	$query_factura 		 = mysqli_query($con,$sql_factura);
	$row_factura 		 = mysqli_fetch_array($query_factura);
	$plantilla_titulo 	 = $row_factura['plantilla_titulo'];
	$plantilla_cuerpo 	 = $row_factura['plantilla_cuerpo'];
	//Datos del cliente
	$sql_cliente 		 = "select * from clientes where cliente_id='".$id_factura."'";
	$query_cliente 		 = mysqli_query($con,$sql_cliente);
	$row_cliente 		 = mysqli_fetch_array($query_cliente);
	$user_email 	 	 = $row_cliente['cliente_email'];
	//
	include "../mail/enviarCorreoMkt/sendemail.php";//Mando a llamar la funcion que se encarga de enviar el correo electronico
	include "../config/general.php";
	//include "../config/servidorCorreo.php";
	//datos de la empresa
	$sql_empresa 			= mysqli_query($con,"select * from datosempresa where datosEmpresa_id=$empresa");
	$rw_empresa 			= mysqli_fetch_array($sql_empresa);
	$datosEmpresa_nombre 	= $rw_empresa['datosEmpresa_nombre'];
	$datosEmpresa_web 		= $rw_empresa['datosEmpresa_web'];
	$datosEmpresa_telefono 		= $rw_empresa['datosEmpresa_telefono'];
	$datosEmpresa_correo 		= $rw_empresa['datosEmpresa_correo'];
	$datosEmpresa_logo 		= $rw_empresa['datosEmpresa_logo'];
	$datosEmpresa_ruc 		= $rw_empresa['datosEmpresa_ruc'];
   /*Configuracion de variables para enviar el correo*/
	$mail_username 		= $usuario;//Correo electronico saliente ejemplo: tucorreo@gmail.com
	$mail_userpassword 	= $clave;//Tu contrase単a de gmail
   	$mail_addAddress 	= $user_email;
   	/*Inicio captura de datos enviados por $_POST para enviar el correo */
	$mail_setFromEmail 	= $emisor;//tu correo de gmail
	$mail_setFromName 	= $datosEmpresa_nombre;//nombre
	$nomempresa = $datosEmpresa_nombre;
	$telefono 	= $datosEmpresa_telefono;
	$correo 	= $datosEmpresa_correo;

	$sistema 	  = $datosEmpresa_nombre;
	$sistema_ruta = $datosEmpresa_web;
	$template="../mail/enviarCorreoMkt/email_template.html";
	$url1 = $ruta.'/img/company/'.$datosEmpresa_ruc.'/'.$datosEmpresa_logo;

   	$mail_subject = $plantilla_titulo;
   	$txt_message  = htmlspecialchars_decode($plantilla_cuerpo);
   	sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$nomempresa,$telefono,$correo,$txt_message,$sistema,$sistema_ruta,$mail_subject,$url1,$template);//Enviar el mensaje
} 
?>