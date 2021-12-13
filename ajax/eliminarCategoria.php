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
if (empty($_POST['id_categoria'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_categoria'])) {
    $id_categoria       = intval($_POST['id_categoria']);
    $query              = mysqli_query($con, "select * from productos where producto_idCategoria='".$id_categoria."'");
    $count              = mysqli_num_rows($query);
    if ($count == 0) {
        if ($delete1    = mysqli_query($con, "delete from categorias where categoria_id='".$id_categoria."'")) { ?>
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
            toastr["error"]("Categor&iacute;a asociada con productos", "Oopss!");
            //console.log(<?php echo $id_categoria; ?>)
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