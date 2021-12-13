
    <?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../config/general.php";
require_once "../config/db.php";
require_once "../config/conexion.php";

$fecha       = date('Y-m-d');
$hora        = date('H_i_s');

$registro    = $fecha."_".$hora;

$product_id    = intval($_REQUEST['id_producto']);
$target_dir    = "../img/company/";
$image_name    = "logo_".$product_id."_".$registro.".jpg";
$target_file   = $target_dir . $image_name;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$imageFileZise = $_FILES["imagefile_mod"]["size"];

/* Inicio Validacion*/
// Allow certain file formats
//if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") and $imageFileZise > 0) {
    //$errors[] = "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
//} else if ($imageFileZise > 10485760) {
//1048576 byte=1MB
    //$errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 10MB</p>";
//} else if (empty($product_id)) {
    //$errors[] = "<p>ID del producto está vacío.</p>";
//} else {

    /* Fin Validacion*/
    //if ($imageFileZise > 0) {
        move_uploaded_file($_FILES["imagefile_mod"]["tmp_name"], $target_file);
        $imagen     = basename($_FILES["imagefile_mod"]["name"]);
        $img_update = "datosEmpresa_logo='$image_name'";

    //} else { $img_update = "";}

    $sql              = "update datosempresa set $img_update where datosEmpresa_id='1'";
    $query_new_insert = mysqli_query($con, $sql);

    if ($query_new_insert) {
        ?>
                        <!--<img src="../img/company/<?php echo $image_name; ?>" id="getProductImage" class="thumbnail" style="width:100%;">-->
                        <script>
                            toastr["success"]("Logo actualizado", "Bien hecho!");
                        </script>
                        <?php
} else {
        //$errors[] = "Lo sentimos, actualización falló. Intente nuevamente. " . mysqli_error($con); ?>
                <script>
                    toastr["error"]("Error al cargar", "Oopps!");
                </script>
    <?php }

//}

?>

    <?php
if (isset($errors)) {
    ?>
                                        <div class="alert alert-danger">
                                            <strong>Error! </strong>
                                            <?php
foreach ($errors as $error) {
        echo $error;
    }
    ?>
                                        </div>
                                            <?php
}
?>
                                    <?php
if (isset($messages)) {
    ?>
                                        <div class="alert alert-success">
                                            <strong>Aviso! </strong>
                                            <?php
foreach ($messages as $message) {
        echo $message;
    }
    ?>
                                        </div>
                                            <?php
}
?>