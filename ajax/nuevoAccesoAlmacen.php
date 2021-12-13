<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com    sucursal_nombre,sucursal_direccion
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');

if (empty($_POST['nombre_accesoUsuario'])){
    $errors[] = "Coloque nombre";
}
elseif ( !empty($_POST['nombre_accesoUsuario'])) {
    $grupo_nombre   = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_accesoUsuario"],ENT_QUOTES)));
    $grupo_estado      = 1;
    
         $sql = "insert into grupo_usuario (
            nombre_grupo,
            estado_grupo)
            values (
            '".$grupo_nombre."',
            1
            )";
        $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){ ?>
            <script>
                toastr["success"]("Datos registrados", "Bien hecho!");
            </script>
        <?php } else{ ?>
            <script>
                toastr["warning"]("<?php echo mysqli_error($con); ?>", "Aviso!");
            </script>
        <?php }
    }
    
    
    if (isset($errors)){
        
        ?>
        <div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert">
        <?php
        foreach ($errors as $error) {
                echo $error;
            }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="la la-close"></span>
        </button>
        </div>
        <?php
        }
        if (isset($messages)){
            
            ?>
        <div class="alert alert-success alert-outline alert-dismissible fade show" role="alert">
        <?php
        foreach ($messages as $message) {
                echo $message;
            }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="la la-close"></span>
        </button>
        </div>
            <?php
        }

?>