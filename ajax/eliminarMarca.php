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
if (empty($_POST['id_marca'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_marca'])) {
    $id_marca       = intval($_POST['id_marca']);
    $query              = mysqli_query($con, "select * from productos where producto_idMarca='".$id_marca."'");
    $count              = mysqli_num_rows($query);
    if ($count == 0) {
        if ($delete1    = mysqli_query($con, "delete from marcas where marca_id='".$id_marca."'")) { ?>
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
            toastr["error"]("Marca asociada con productos", "Oopss!");
            console.log(<?php echo $id_marca; ?>)
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