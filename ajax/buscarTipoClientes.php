<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
    
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    
if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q        = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('sunat_tipoCliente_nombre');//Columnas de busqueda
    $sTable = "sunat_tipocliente";
    $sWhere = "WHERE sunat_tipoCliente_id>0";
    if ( $_GET['q'] != "" )
    {
    $sWhere.= " AND (sunat_tipoCliente_nombre like '%$q%' or sunat_tipoCliente_codigo like '%$q%')";
    }
    $sWhere.=" order by sunat_tipoCliente_id asc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 10; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = './cn_clientes.php';
    //main query to fetch the data
    $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
    $a = 1;
    //loop through fetched data
    if ($numrows>0){ ?>
        <div class="table-responsive">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>C&oacute;digo</th>
                        <th>Descripci&oacute;n</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($row=mysqli_fetch_array($query)){
                    $sunat_tipoCliente_id     = $row['sunat_tipoCliente_id'];
                    $sunat_tipoCliente_nombre = $row['sunat_tipoCliente_nombre'];
                    $sunat_tipoCliente_codigo    = $row['sunat_tipoCliente_codigo'];
                ?>
                    <tr>
                        <input type="hidden" value="<?php echo $sunat_tipoCliente_nombre;?>" id="empresa_nombre<?php echo $sunat_tipoCliente_id;?>">
                        <input type="hidden" value="<?php echo $sunat_tipoCliente_codigo;?>" id="sunat_tipoCliente_codigo<?php echo $sunat_tipoCliente_id;?>">
                        <td><?php echo $a++; ?></td>
                        <td><?php echo $sunat_tipoCliente_codigo; ?></td>
                        <td><?php echo $sunat_tipoCliente_nombre; ?></td>
                        <td>
                            <div class="dropleft dropup">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;"><i class="la la-cog"></i></a>
                                <div class="dropdown-menu" >
                                    <a class="dropdown-item" href="#">Editar</a>
                                    <a class="dropdown-item" href="#">Eliminar</a>
                                    <a class="dropdown-item" href="#">Detalles</a>
                                    <a class="dropdown-item" href="#">Historial</a>
                                    <a class="dropdown-item" href="#">Desactivar</a>
                                </div>
                            </div>
                        </td>
                            
                    </tr>
                <?php
                    //$numrows=$numrows-1;
                }
                ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
            </nav>
        </div>
    <?php }else{ ?>
        <br><br><br>
            <div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert" style="text-align: center;">
                <img src="../img/company/pacman.gif">
                <br>
                <strong>Oopss!</strong> No se han encontrado registros en nuestra base de datos. <a href="#" class="alert-link">Crear cliente</a>
            </div>
    <?php }
}
?>