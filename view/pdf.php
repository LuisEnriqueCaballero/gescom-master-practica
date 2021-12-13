<?php

$decode 	= $_GET['doc'];
$id_product = base64_decode($decode);

header("location:".$id_product);