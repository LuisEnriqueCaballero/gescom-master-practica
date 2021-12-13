<?php
function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$usuario_alias,$nomempresa,$url1,$url2,$url3,$url4,$url5,$url6,$telefono,$correo,$new_password,$txt_message,$sistema,$sistema_ruta,$mail_subject,$template){
	require '../mail/PHPMailer/PHPMailerAutoload.php';
	include "../config/general.php";
	$smtp = new PHPMailer;
	# Indicamos que vamos a utilizarn un servidor SMTP
	$smtp->IsSMTP();
	# Definimos el formato del correo con UTF-8      
	$smtp->CharSet="UTF-8";
	# autenticación contra nuestro servidor smtp
	$smtp->SMTPAuth = true;
	$smtp->Host = $host;
	$smtp->Username = $mail_username;
	$smtp->Password = $mail_userpassword;
	# datos de quien realiza el envio
	$smtp->setFrom($mail_setFromEmail, $mail_setFromName);
	$smtp->addReplyTo($mail_setFromEmail, $mail_setFromName);
	# Indicamos la dirección donde enviar el mensaje

	$smtp->SMTPSecure = $smtpsecure;
	$smtp->Port = $puerto;

	# establecemos un limite de caracteres de anchura
	$smtp->WordWrap   = 50;

	# NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
	# cualquier programa de correo pueda leerlo.

	# Definimos el contenido HTML del correo
	$message = file_get_contents($template);
	$message = str_replace('{{first_name}}', $mail_setFromName, $message);
	$message = str_replace('{{message}}', $txt_message, $message);
	$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
	$message = str_replace('{{cliente}}', $mail_addAddress, $message);
	//
	$message = str_replace('{{customer_name}}', $usuario_alias, $message);
	$message = str_replace('{{empresa}}', $nomempresa, $message);
	$message = str_replace('{{password}}', $new_password, $message);

	$message = str_replace('{{telefono}}', $telefono, $message);
	$message = str_replace('{{correo}}', $correo, $message);

	$message = str_replace('{{logo}}', $url1, $message);
	$message = str_replace('{{imfacebook}}', $url2, $message);
	$message = str_replace('{{imtwitter}}', $url3, $message);
	$message = str_replace('{{divider}}', $url4, $message);
	$message = str_replace('{{redondo}}', $url5, $message);
	$message = str_replace('{{abajo}}', $url6, $message);

	$message = str_replace('{{sistema}}', $sistema, $message);
	$message = str_replace('{{sistema_ruta}}', $sistema_ruta, $message);
	# $smtp->isHTML(true);

	# Definimos el contenido en formato Texto del correo
	$contenidoTexto="Contenido en formato Texto";
	$contenidoTexto.="\n\nhttps://www.rilaros.com";
	
	# Definimos el subject
	$smtp->Subject = $mail_subject;

	# Adjuntamos el archivo "leameLWP.txt" al correo.
	# Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
	# archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
	# script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
	# /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
	# /home/xve/test/leameLWP.txt
	# $rutaAbsoluta=substr($_SERVER["SCRIPT_FILENAME"],0,strrpos($_SERVER["SCRIPT_FILENAME"],"/"));
	# $smtp->AddAttachment($rutaAbsoluta."/pdf/documentos/factura-firmada/10725799093-01-F001-00000001.XML", "F.xml");


	$smtp->AltBody=$contenidoTexto; //Text Body
	$smtp->msgHTML($message);

	$smtp->addAddress($mail_addAddress);

	if(!$smtp->send()) {
		//echo '<div class="alert alert-danger">No se pudo enviar el mensaje..';
		//echo 'Error de correo: ' . $smtp->ErrorInfo."</div>";
		echo '<div class="showback" style="width:100%;">';
		echo '<div class="alert alert-danger alert-dismissable">';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo '<strong>No se pudo enviar el mensaje!. <br></strong>';
		echo '<span>Error de correo: ' . $smtp->ErrorInfo.'</span>';
		echo '</div>';
		echo '</div>';
	} else {
		//echo '<div class="alert alert-success" style="margin-bottom: -1px; margin-top: 5px;">Tu mensaje ha sido enviado!</div>';
		echo '<div class="showback" style="width:100%;">';
		echo '<div class="alert alert-success alert-dismissable">';
		//echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		echo '<strong>Revisa tu bandeja de entrada o de SPAM</strong>';
		echo '</div>';
		echo '</div>';

		
		}
}
?>