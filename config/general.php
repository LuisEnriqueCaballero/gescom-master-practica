<?php
//Datos de la coneccion a la base de datos
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$servidorbd     = $_ENV['DB_HOST']; //servidor
$usuariobd      = $_ENV['DB_USERNAME']; //usuario
$clavebd        = $_ENV['DB_PASSWORD']; //password
$basebd         = $_ENV['DB_DATABASE']; //nombre de la base de datos

//Ruta donde esta alojado el sistema (se utiliza para el envio de correo con pdf y xml adjuntos)
// $ruta = 'https://demo.rilaros.com/sistemagc';//esta ruta no debe terminar con un slash (/)
$ruta = $_ENV['RUTA']; //esta ruta no debe terminar con un slash (/)
//Ruta donde esta alojado el sistema (administrador)
//$ruta_admin = 'http://localhost/molipos_admin';//esta ruta no debe terminar con un slash (/)
//Definimos la zona horaria
date_default_timezone_set('America/Lima');
//Servidor de correo smtp
$usuario = 'info@code-free.cf'; //usuario o correo smtp
$clave = 'clarodeluna199407'; //clave del usuario o correo smtp
$host = 'sv87.ifastnet.com'; //servidor smtp
$smtpsecure = 'ssl'; //encriptacion
$puerto = 290; //puerto
//Datos en el correo
$emisor = 'info@rilaros.com'; //correo emisor de documentos electronicos (ejem: facturacion@dominio.com)
$emisor_mkt = 'info@rilaros.com'; //correo emisor de correo publicitario (ejem: ventas@dominio.com)
//Sitio web
$web_config = 'www.rilaros.com';
//Nombre del sistema
$sistema_name = "ATIRPAY SOLUTIONS";