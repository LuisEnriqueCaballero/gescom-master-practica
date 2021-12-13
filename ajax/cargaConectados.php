<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
include("../config/db.php");
include("../config/conexion.php");
$tienda = $_SESSION['tienda'];
$usuarioActual = $_SESSION['usuario_id'];
$sql = "select * from usuarios, colaboradores where usuarios.usuario_idColaborador=colaboradores.colaborador_id and colaboradores.colaborador_sucursal='$tienda' and usuario_id!='$usuarioActual' order by usuarios.usuario_status asc";
$query = mysqli_query($con,$sql);
?>
<ul class="list-group list-group-flush bg-white">
    <?php
    while ($row = mysqli_fetch_array($query)) {
        $usuario_alias          = $row['usuario_alias'];
        $colaborador_nombres    = $row['colaborador_nombres'];
        $usuario_status         = $row['usuario_status'];
        $colaborador_foto       = $row['colaborador_foto'];

        if ($usuario_status == 'Activo ahora') {
            $label = 'success';
        }
        if ($usuario_status == 'Desconectado ahora') {
            $label = 'danger';
        }
    ?>
    <li class="list-group-item bg-white">
        <div class="media">
            <img class="align-self-center mr-3 rounded-circle" src="../img/user/<?php echo $colaborador_foto; ?>" alt=" " style="width: 35px;">
            <div class="media-body p-t-10">
                <p class="mb-0 d-inline"><b><?php echo $usuario_alias; ?></b><br><small><?php echo $colaborador_nombres; ?></small></p>
                <span class="badge badge-pill badge-<?php echo $label; ?> float-right"><?php echo $usuario_status; ?></span>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>