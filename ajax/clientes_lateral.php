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
    $aColumns = array('cliente_nombre');//Columnas de busqueda
    $sTable = "clientes";
    $sWhere = "WHERE cliente_id>0";
    if ( $_GET['q'] != "" )
    {
    $sWhere.= " AND (cliente_nombre like '%$q%' or cliente_documento like '%$q%' or cliente_contacto like '%$q%')";
    }
    $sWhere.=" order by cliente_id desc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 999999; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = './index.php';
    //main query to fetch the data
    $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    ?>
    <!--END START SEARCH WRAPPER -->
    <!--START RIGHT SIDEBAR CONTACT LIST -->
    <div class="qt-scroll" data-scroll="minimal-dark">
        <ul class="list-group p-0">
            <?php
                if ($numrows>0) {
                    while ($row=mysqli_fetch_array($query)) {
                    $cliente_id         = $row['cliente_id'];
                    $cliente_nombre     = $row['cliente_nombre'];
                    $cliente_documento  = $row['cliente_documento'];
                    $cliente_telefono   = $row['cliente_telefono'];
                    $cliente_contacto   = $row['cliente_contacto'];
                    $cliente_email      = $row['cliente_email'];
                    $cliente_tipo       = $row['cliente_tipo'];
            ?>
            <li class="list-group-item bg-white" data-chat="open" data-chat-name="<?php echo $cliente_nombre; ?>">
                <span class="float-left"><img src="../assets/img/avatars/01.jpg" alt="" class="rounded-circle max-w-50 m-r-10"></span>
                <i class="badge mini success status"></i>
                <div class="list-group-item-body">
                    <div class="list-group-item-heading"><?php echo $cliente_nombre; ?></div>
                    <div class="list-group-item-text"><?php echo $cliente_documento; ?></div>
                </div>
            </li>
            <?php   } 
                } else { ?>
            <div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert" style="text-align: center;">
                <img src="../img/company/lluvia.svg" style="height: 100px;">
                <br>
                <a href="#" class="alert-link">Crear cliente</a>
            </div>
        </ul>
    </div>
    <!--END RIGHT SIDEBAR CONTACT LIST -->
<?php }
}
?>