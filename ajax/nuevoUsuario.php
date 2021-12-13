<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include('is_logged.php');
if (empty($_POST['colaborador_id'])){
    $errors[] = "Id vac&iacute;o";
}
elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
    //$errors[] = "Las contra&ntilde;as no coinciden"; ?>
    <script>
        toastr["warning"]("Las contrase&ntilde;as no coinciden", "Aviso!");
    </script>
<?php }
elseif (!empty($_POST['colaborador_id'])) {
    
    $colaborador_id         = intval($_POST['colaborador_id']);
    $user_name              = mysqli_real_escape_string($con,(strip_tags($_POST["user_name"],ENT_QUOTES)));
    $user_password_new      = md5(mysqli_real_escape_string($con,$_POST['user_password_new']));
    $user_password_repeat   = md5(mysqli_real_escape_string($con,$_POST['user_password_repeat']));
    $acceso                 = 1;
    $usuario_fechaRegistro  = date("Y-m-d H:mm:ss");
        
    $sql1 = "select * from usuarios where usuario_alias='".$user_name."'";
    $query_check_marca = mysqli_query($con,$sql1);
    $query_check_marca=mysqli_num_rows($query_check_marca);

    if ($query_check_marca == 1) { ?>
        <script>
            toastr["info"]("El nombre de usuario ya est&aacute; en uso", "Aviso!");
        </script>
    <?php }else{
         $sql = "insert into usuarios (
            usuario_clave,
            usuario_alias,
            usuario_registro,
            usuario_accesos,
            usuario_idColaborador)
            values (
            '".$user_password_new."',
            '".$user_name."',
            '".$usuario_fechaRegistro."',
            '".$acceso."',
            '".$colaborador_id."'
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
    }else { ?>
        <script>
            toastr["error"]("Error desconocido", "Oopss!");
        </script>
<?php }
    
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