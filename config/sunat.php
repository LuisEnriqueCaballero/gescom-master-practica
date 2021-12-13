<?php
include ("general.php");
//db details
$dbHost = $servidorbd;
$dbUsername = $usuariobd;
$dbPassword = $clavebd;
$dbName = $basebd;

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>