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
if (empty($_POST['id_cliente'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_cliente'])) {
    $id_cliente     = intval($_POST['id_cliente']);
    $query              = mysqli_query($con, "select * from facturas where factura_idCliente='".$id_cliente."'");
    $count              = mysqli_num_rows($query);
    if ($count == 0) {
        if ($delete1    = mysqli_query($con, "delete from clientes where cliente_id='".$id_cliente."'")) { ?>
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
            toastr["error"]("Cliente asociado con documentos", "Oopss!");
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