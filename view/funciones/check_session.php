<?php  
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
if(isset($_SESSION["usuario_id"]))
{
	echo '0';
}
else
{
	echo '1';
}