<?php
session_start();
if(!empty($_SESSION['usuario_id']))
{
$_SESSION['usuario_id']='';
session_destroy();
}

header("Location:../login/");