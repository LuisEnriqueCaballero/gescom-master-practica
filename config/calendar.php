<?php

include ("general.php");

try
{
	$bdd = new PDO('mysql:host='.$servidorbd.';dbname='.$basebd.';charset=utf8', $usuariobd, $clavebd);
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
