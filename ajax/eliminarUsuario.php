<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_usuario'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_usuario'])) {
    $id_usuario     = intval($_POST['id_usuario']);
    //$sql_usuario        = mysqli_query($con,"select * from usuarios where usuario_idColaborador='".$id_usuario."'");
    //$rw_tipoDocumento   = mysqli_fetch_array($sql_usuario);
    //$usuario_id         = $rw_tipoDocumento['usuario_id'];
    $query              = mysqli_query($con, "select * from facturas where factura_idUsuario='".$id_usuario."'");
    $count              = mysqli_num_rows($query);
    if ($count == 0) {
        if ($delete1    = mysqli_query($con, "delete from usuarios where usuario_id='".$id_usuario."'")) { ?>
            <script>
                toastr["success"]("Datos eliminados", "Bien hecho!");
            </script>
        <?php
        } else { ?>
            <script>
                toastr["warning"]("<?php echo mysqli_error($con); ?>", "Aviso!");
            </script>
      <?php }

    } else { ?>
        <script>
            toastr["error"]("Usuario asociado con documentos", "Oopss!");
        </script>
  <?php }
} else {
    $errors[] = "Error desconocido.";
}
if (isset($errors)) { ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
            foreach ($errors as $error) {
                echo $error;
            }
        ?>
    </div>
<?php } ?>