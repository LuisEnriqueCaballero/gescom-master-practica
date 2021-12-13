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
	
if (empty($_POST['cliente_correo'])) {
    $errors[] = "Correo vacio"; ?>
	<script>
		toastr["warning"]("Correo electr&oacute;nico vac&iacute;o", "Aviso!");
	</script>
    <?php }
else if (!empty($_POST['cliente_correo'])) {
	
	$user_email	= $_POST['cliente_correo'];
	$id_factura	= $_POST['id_factura'];
	//Datos de la factura
	$sql_factura 		 = "select * from facturas where factura_id='".$id_factura."'";
	$query_factura 		 = mysqli_query($con,$sql_factura);
	$row_factura 		 = mysqli_fetch_array($query_factura);
	$factura_idCliente 	 = $row_factura['factura_idCliente'];
	$factura_folio 		 = $row_factura['factura_folio'];
	$factura_correlativo = $row_factura['factura_correlativo'];
	$factura_tipo 		 = $row_factura['factura_tipo'];
	$factura_ventaTotal  = number_format($row_factura['factura_ventaTotal'],2);
	$factura_moneda  	 = $row_factura['factura_moneda'];
	$factura_fecha  	 = $row_factura['factura_fecha'];
	//Numero de factura
	$numero_factura1 	 = str_pad($factura_correlativo, 8, "0", STR_PAD_LEFT);
	//Tipo de documento
	if($factura_tipo==1){
        $tipo_documento="01";//FACTURA
        $nombre_documento="FACTURA";
    }
    if($factura_tipo==2){
        $tipo_documento="03";//BOLETA
        $nombre_documento="BOLETA";
    }
    if($factura_tipo==4){
        $tipo_documento="08";//NOTA DE DEBITO
        $nombre_documento="NOTA DE D&Eacute;BITO";
    }
    if($factura_tipo==3){
        $tipo_documento="07";//NOTA DE CREDITO
        $nombre_documento="NOTA DE CR&Eacute;DITO";
    }
    if($factura_tipo==7){
        $tipo_documento="08";//NOTA DE DEBITO
        $nombre_documento="NOTA DE D&Eacute;BITO";
    }
    if($factura_tipo==6){
        $tipo_documento="07";//NOTA DE CREDITO
        $nombre_documento="NOTA DE CR&Eacute;DITO";
    }
    //Moneda
    if ($factura_moneda==115) {
		$moneda1="SOLES";
		$moneda2="S/ ";
	}
	if ($factura_moneda==151) {
		$moneda1="DOLARES";
		$moneda2="$ ";
	}
	//Datos del cliente
	$sql_cliente 		 = "select * from clientes where cliente_id='".$factura_idCliente."'";
	$query_cliente 		 = mysqli_query($con,$sql_cliente);
	$row_cliente 		 = mysqli_fetch_array($query_cliente);
	$cliente_nombre 	 = $row_cliente['cliente_nombre'];
	//
	include "../mail/enviarCorreo/sendemail.php";//Mando a llamar la funcion que se encarga de enviar el correo electronico
	include "../config/general.php";
	//datos de la empresa
	$sql_empresa 			= mysqli_query($con,"select * from datosempresa where datosEmpresa_id='1'");
	$rw_empresa 			= mysqli_fetch_array($sql_empresa);
	$datosEmpresa_nombre 	= $rw_empresa['datosEmpresa_nombre'];
	$datosEmpresa_ruc 		= $rw_empresa['datosEmpresa_ruc'];
	$datosEmpresa_telefono 	= $rw_empresa['datosEmpresa_telefono'];
	$datosEmpresa_correo 	= $rw_empresa['datosEmpresa_correo'];
	$datosEmpresa_logo 		= $rw_empresa['datosEmpresa_logo'];
	$datosEmpresa_web 		= $rw_empresa['datosEmpresa_web'];
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

	$documento  = $nombre_documento;
	$folio 		= $factura_folio;
	$numero 	= $factura_correlativo;

	$doc1 		= "$datosEmpresa_ruc-$tipo_documento-$factura_folio-$numero_factura1.XML";
	$datospdf 	= "$datosEmpresa_ruc-$tipo_documento-$factura_folio-$factura_correlativo.pdf";
	//$new_password = $pass;
	$template="../mail/enviarCorreo/email_template.html";
	$url1 = $ruta.'/img/company/'.$datosEmpresa_logo;
	$url2 = $ruta.'/mail/password/images/facebook@2x.png';
	$url3 = $ruta.'/mail/password/images/twitter@2x.png';
	$url4 = $ruta.'/mail/password/images/divider.png';
	$url5 = $ruta.'/mail/password/images/rounder-up.png';
	$url6 = $ruta.'/mail/password/images/rounder-dwn.png';

	$sistema 	  = $datosEmpresa_nombre;
	$sistema_ruta = $datosEmpresa_web;

	$ruta_pdf = $ruta.'/view/pdf/documentos/a4.php?comp='.$id_factura;
	$ruta_xml = $ruta.'/view/pdf/documentos/factura-firmada/'.$datosEmpresa_ruc.'-'.$tipo_documento.'-'.$factura_folio.'-'.$numero_factura1.'.XML';

   	$mail_subject = $nombre_documento." | ".$factura_folio."-".$factura_correlativo." | ".$datosEmpresa_nombre;
   	$txt_message  = "Se adjuntan el archivo PDF y la firma XML en este correo.";
   	sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$cliente_nombre,$nomempresa,$url1,$url2,$url3,$url4,$url5,$url6,$telefono,$correo,$txt_message,$sistema,$sistema_ruta,$mail_subject,$doc1,$datospdf,$factura_fecha,$moneda1,$factura_ventaTotal,$documento,$folio,$numero,$ruta_pdf,$ruta_xml,$template);//Enviar el mensaje
} 
?>