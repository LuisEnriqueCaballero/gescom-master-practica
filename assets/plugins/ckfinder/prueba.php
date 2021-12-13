<?php
$base = $_SERVER['HTTP_HOST'];
$ruta = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
echo $base."/".$ruta; ?>