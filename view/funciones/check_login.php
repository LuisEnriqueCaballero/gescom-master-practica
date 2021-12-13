<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include ("../../config/general.php");
if(isset($_POST["username"]) && isset($_POST['password']))
{
  $connect = new PDO('mysql:host='.$servidorbd.';dbname='.$basebd.';charset=utf8', $usuariobd, $clavebd);
  session_start();
  $username=($_POST['username']); 
  $password=md5($_POST['password']);
  $query = "select * from usuarios where usuario_alias='$username' and usuario_clave='$password'";
  $statement = $connect->prepare($query);
  $statement->execute();
  $total_row = $statement->rowCount();
  $output = '';
  if($total_row == 1)
  {
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      echo $row['usuario_id'];
      $_SESSION['usuario_id']     = $row['usuario_id'];

      $_SESSION['usuario_idColaborador'] = $row['usuario_idColaborador'];
      $idColaborador = $_SESSION['usuario_idColaborador'];

      $sql_colaborador  = mysqli_query($con,"select * from colaboradores where colaborador_id='$idColaborador'");
      $rw_colaborador   = mysqli_fetch_array($sql_colaborador);
      $colaborador_id   = $rw_colaborador['colaborador_id'];

      //Datos de la tabla usuarios
      $_SESSION['usuario_alias']    = $row['usuario_alias'];
      $_SESSION['usuario_clave']    = $row['usuario_clave'];

      //Datos de la tabla colaboradores
      $_SESSION['tienda']       = $rw_colaborador['colaborador_sucursal'];
      $_SESSION['usuario_foto']     = $rw_colaborador['colaborador_foto'];
      $_SESSION['usuario_sexo']     = $rw_colaborador['colaborador_sexo'];
      $_SESSION['usuario_email']    = $rw_colaborador['colaborador_telefono'];
      $_SESSION['usuario_nombres']  = $rw_colaborador['colaborador_nombres'];
      $_SESSION['usuario_telefono']   = $rw_colaborador['colaborador_telefono'];
      $_SESSION['usuario_domicilio']  = $rw_colaborador['colaborador_domicilio'];
      $_SESSION['usuario_documento']  = $rw_colaborador['colaborador_documento'];

      $_SESSION['user_login_status']  = 1;
    }
  }
echo $output;
}

?>