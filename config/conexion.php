<?php
    $con=@mysqli_connect($servidorbd, $usuariobd, $clavebd, $basebd);
    if(!$con){
        die("imposible conectarse: ");
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>
