<style>
.drop-zone {
  max-width: 300px;
  height: 300px;
  padding: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #cccccc;
  border: 4px dashed #007bff;
  border-radius: 10px;
}

.drop-zone--over {
  border-style: solid;
}

.drop-zone__input {
  display: none;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}
</style>
<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../config/db.php";
require_once "../config/conexion.php";
if (isset($_REQUEST['id_producto'])) {
    $id_producto = intval($_REQUEST['id_producto']);
    $sql_img     = mysqli_query($con, "select * from productos where producto_id='$id_producto'");
    $rw          = mysqli_fetch_array($sql_img);
    $url         = $rw['producto_foto'];
    $producto_nombre         = $rw['producto_nombre'];
    $producto_codigoBarras         = $rw['producto_codigoBarras'];
    ?>
<div style="margin-left: 18%;">
	<h6>Seleccionar Imagen</h6>
	<div class="drop-zone">
    <span class="drop-zone__prompt">
    	<?php
			if ($url == null) {
	        	echo '<img src="../img/products/nuevo.svg" style="width:250px; height:250px;">';
	    	} else {
	        	echo '<img src="../img/products/'.$url.'" style="width:250px; height:250px;">';
	    	}
	    ?>
    </span>
    <input type="file" id="imagefile_mod" name="imagefile_mod" class="drop-zone__input" onchange="upload_image_mod(<?php echo $id_producto; ?>);">
  </div>
</div>
    
<script>
	//$("#imagefile_mod").fileinput({ });
</script>
<script>


	document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}
</script>
<?php }?>