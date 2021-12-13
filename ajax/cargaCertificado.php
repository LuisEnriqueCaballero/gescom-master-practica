<?php
//echo count($_FILES["file0"]["name"]);exit;
require_once ("../config/db.php");
require_once ("../config/conexion.php");
include ("../config/general.php");
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["fileToUpload"]["type"])){
$target_dir = "../view/pdf/documentos/certificados/produccion/";
$carpeta=$target_dir;
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

/*$query_id = mysqli_query($con, "SELECT RIGHT(tipo_media,6) as tipo_media FROM media ORDER BY tipo_media DESC LIMIT 1")
or die('error ' . mysqli_error($con));
$count = mysqli_num_rows($query_id);

if ($count != 0) {

$data_id = mysqli_fetch_assoc($query_id);
$tipo_media  = $data_id['tipo_media'] + 1;
} else {
$tipo_media = 1;
}

$buat_id = str_pad($tipo_media, 5, STR_PAD_LEFT);
$tipo_media  = "$buat_id";*/
$sql_empresa=mysqli_query($con,"select * from datosempresa");
$rw_tienda=mysqli_fetch_array($sql_empresa);
$datosEmpresa_ruc=$rw_tienda['datosEmpresa_ruc'];
$nombre = $datosEmpresa_ruc.".pfx";
$target_file = $carpeta . $datosEmpresa_ruc.".pfx";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors[]= "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
/*if (file_exists($nombre)) {

	?>
       <script>
						toastr.options = {
					"closeButton":false,
					"progressBar": false
				};
				toastr.warning("Lo sentimos, archivo ya existe","Precaucion");
				load(1);
				</script>
	   
	   
    <?php

    //$errors[]="Lo sentimos, archivo ya existe.";
    $uploadOk = 0;
}*/
// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 524288) {
    $errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 0.5 MB";
    $uploadOk = 0;
}*/
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF  son permitidos.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errors[]= "Lo sentimos, tu archivo no fue subido.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	$ruta_media=$ruta;

    	

    	//$sql="INSERT INTO media (nombre_media, tipo_media, ruta_media, foto_media) VALUES ('$nombre','$tipo_media','$ruta_media','$tipo_media')";
    	//$query_new_insert = mysqli_query($con,$sql);
    	?>
       <script>
						toastr["success"]("Datos actualizados", "Bien hecho!");
				</script>
	   
	   
    <?php } else { ?>
    	<script>
				toastr["error"]("No se pudo cargar el archivo", "Oopps!");
				</script>
    <?php }
}

if (isset($errors)){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Error!</strong> 
	  <?php
	  foreach ($errors as $error){
		  echo"<p>$error</p>";
	  }
	  ?>
	</div>
	<?php
}

if (isset($messages)){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Aviso!</strong> 
	  <?php
	  foreach ($messages as $message){
		  echo"<p>$message</p>";
	  }
	  ?>
	</div>
	<?php
}
}
?> 