<?php
/*-------------------------
Autor: Delmar Lopez
Web: www.softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../view/funciones/funciones.php";

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q        = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('producto_codigoBarras', 'producto_nombre', 'producto_codigo', 'producto_descripcion'); //Columnas de busqueda
    $sTable   = "productos";
    $sWhere   = " WHERE producto_stock>0 ";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 5; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../vv_nuevaVenta.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
            <div class="table-responsive">
              <table class="display table dt-responsive table-bordered" cellspacing="0" style="width:100%; font-size: 13px;">
                <thead>
                    <tr  class="info">
                        <th class='text-center'>Foto</th>
                        <th class='text-center'>Cod.</th>
                        <th class='text-center'>Descripci&oacute;n</th>
                        <th class='text-center'>Stock</th>
                        <th class='text-center'>Cant.</th>
                        <th class='text-center'>P. Unitario</th>
                        <th class='text-center'><i class="fa fa-shopping-cart"></i></th>
                    </tr>
                </thead>
                <tbody>    
                <?php
                $finales=0;
while ($row = mysqli_fetch_array($query)) {
            $producto_id     = $row['producto_id'];
            $producto_codigoBarras = $row['producto_codigoBarras'];
            $producto_nombre = $row['producto_nombre'];
            $producto_stock  = $row['producto_stock'];
            $precio_venta    = $row["producto_precio"];
            $precio_venta    = number_format($precio_venta, 2, '.', '');
            $producto_foto      = $row['producto_foto'];
            ?>
                    <tr>
                        <td class='text-center'>
                        <?php
if ($producto_foto == null) {
                echo '<img src="../img/products/nuevo.jpg" class="img-fluid" width="35">';
            } else {
                echo '<img src="../img/products/'.$producto_foto.'" class="img-fluid" width="35">';
            }

            ?>
                                <!--<img src="<?php echo $producto_foto; ?>" alt="Product Image" class='rounded-circle' width="60">-->
                        </td>
                        <td><?php echo $producto_codigoBarras; ?></td>
                        <td><?php echo $producto_nombre; ?></td>
                        <td class="text-center"><?php echo stock($producto_stock); ?></td>
                        <td class='col-xs-1' width="15%">
                        <div class="pull-right">
                        <input type="text" class="form-control" style="text-align:center; height: 25px;" id="cantidad_<?php echo $producto_id; ?>"  value="1" >
                        </div>
                        </td>
                        <td class='col-xs-2' width="15%"><div class="pull-right">
                        <input type="text" class="form-control" style="text-align:center; height: 25px;" id="precio_venta_<?php echo $producto_id; ?>"  value="<?php echo $precio_venta; ?>" >
                        </div></td>
                        <td class='text-center'>
                        <a class='btn btn-success btn-sm' title="Agregar a Factura" onclick="agregar('<?php echo $producto_id ?>')" style="cursor: pointer; height: 25px; width: 25px;"><i class="fa fa-plus" style="color: #fff; margin-top: 0px; margin-left: -5px;"></i>
                        </a>
                        </td>
                    </tr>
                    <?php
                    $finales++;
}
        ?>
                </tbody>
              </table>
              <nav aria-label="Page navigation example" class="pull-right">
                <?php
                $inicios=$offset+1;
                $finales+=$inicios -1;
                //echo '<div class="hint-text">Mostrando '.$inicios.' al '.$finales.' de '.$numrows.' registros</div>';
                echo paginate($reload, $page, $total_pages, $adjacents);?>
            </nav>
            </div>
            <?php
}
//Este else Fue agregado de Prueba de prodria Quitar
    else {
        ?>
    <div class='alert alert-secondary alert-outline alert-dismissible fade show' role='alert' style='text-align: center;'><img src='../assets/images/error/internal-server.svg' style='width: 300px;'><br><strong>Oopss!</strong> No se han encontrado registros en nuestra base de datos.</div>
  <?php
}
// fin else
}
?>