
    <?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../config/db.php";
require_once "../config/conexion.php";

$product_id    = intval($_REQUEST['id_producto']);
$target_dir    = "../img/products/ficha/";
$image_name    = "ficha_producto_".$product_id.".pdf";
$target_file   = $target_dir . $image_name;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$imageFileZise = $_FILES["imagefile_mod2"]["type"];

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
        move_uploaded_file($_FILES["imagefile_mod2"]["tmp_name"], $target_file);
        $imagen     = basename($_FILES["imagefile_mod2"]["name"]);
        $img_update = "producto_ficha='$image_name'";
    /* Fin Validacion*/
    //if ($imageFileZise > 0) {
        $sql              = "update productos set $img_update where producto_id='$product_id';";
    $query_new_insert = mysqli_query($con, $sql);

    if ($query_new_insert) {

    //} else { $img_update = "";}
        ?>
        				<iframe src="../img/products/ficha/<?php echo $image_name; ?>" id="getProductImage" class="thumbnail" style="width:250px; height:250px;"> </iframe>
                        <script>
                            toastr["success"]("Archivo cargado", "Bien hecho!");
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