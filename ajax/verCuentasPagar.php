<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
//$id_credito = $_POST['id_credito'];
/* Connect To Database*/
require_once "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
//include "../permisos.php";
//Archivo de funciones PHP
//require_once "../view/funciones/funciones.php";
$user_id       = $_SESSION['usuario_id'];
$tienda        = $_SESSION['tienda'];
//$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$action         = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange = mysqli_real_escape_string($con, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $id_credito = intval($_REQUEST['id_credito']);
    $tables    = "credito_proveedor, creditos_abonos";
    $campos    = "*";
    $sWhere    = "credito_proveedor.id_credito='".$id_credito."' and creditos_abonos.numero_factura=credito_proveedor.numero and creditos_abonos.abono_folio=.credito_proveedor.folio and creditos_abonos.id_sucursal='".$tienda."'";
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and creditos_abonos.fecha_abono between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by creditos_abonos.id_abono DESC";

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
    if ($row = mysqli_fetch_array($count_query)) {$numrows = $row['numrows'];} else {echo mysqli_error($con);}
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../ver_cxc.php';
    //main query to fetch the data
    $query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
    //loop through fetched data

    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
            <table class="display table dt-responsive" style="width:100%">
                <tr>
                    <th>#</th>
                    <th>Doc</th>
                    <th>Fecha</th>
                    <th>Cr&eacute;dito</th>
                    <th>Abonos</th>
                    <th>Saldo</th>
                    <th>Usuario</th>
                    <th></th>
                </tr>
                <?php
$finales = 0;
$a = 1;
        while ($row = mysqli_fetch_array($query)) {
            $id_users = $row['id_users_abono'];
            $sql      = mysqli_query($con, "select usuario_alias from usuarios where usuario_id='" . $id_users . "'");
            $rw       = mysqli_fetch_array($sql);
            $usuario  = $rw['usuario_alias'];
            ?>
                    <tr>
                        <td><?php echo $a++; ?></td>
                        <td><label class='badge badge-secondary'><?php echo $row['folio']."-".$row['numero']; ?></label></td>
                        <td><?php echo date("d/m/Y", strtotime($row['fecha_abono'])); ?></td>
                        <td><?php echo /*$simbolo_moneda . '' . */number_format($row['monto_abono'], 2); ?></td>
                        <td><?php echo /*$simbolo_moneda . '' . */number_format($row['abono'], 2); ?></td>
                        <td><?php echo /*$simbolo_moneda . '' . */number_format($row['saldo_abono'], 2); ?></td>
                        <td><?php echo $usuario; ?></td>
                        <td><a class='btn btn-info btn-xs waves-effect waves-light' style="cursor: pointer;" onclick="imprimir_abono('<?php echo $row['id_abono']; ?>');"><i class="la la-print" style="color: #fff;"></i>
                        </a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>

            <nav aria-label="clearfix">
                <?php
                $inicios=$offset+1;
                $finales+=$inicios -1;
                echo '<div class="hint-text">Mostrando '.$inicios.' al '.$finales.' de '.$numrows.' registros</div>';
                echo paginate($reload, $page, $total_pages, $adjacents);?>
            </nav>

            <?php
} else { ?>
          <div class='alert alert-secondary alert-outline alert-dismissible fade show' role='alert' style='text-align: center;'><img src='../assets/images/error/internal-server.svg' style='width: 300px;'><br><strong>Oopss!</strong> No se han encontrado registros en nuestra base de datos.</div>
<?php }
}
?>

