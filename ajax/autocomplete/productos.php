<?php
if (isset($_GET['term'])) {
    include '../is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../../config/db.php");
    include("../../config/conexion.php");

    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {
        $tienda1=$_SESSION['tienda'];
        $almacen = $_SESSION['almacen'];
        $fetch = mysqli_query($con, "select * from productos where (producto_nombre like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' or producto_codigo like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' or producto_codigoBarras like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%') and producto_idSucursal=$almacen LIMIT 0 ,50");

        /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $producto_id                  = $row['producto_id'];
            $row_array['value']           = $row['producto_codigoBarras']." | ".$row['producto_nombre'];
            $row_array['producto_id']     = $producto_id;
            $row_array['producto_nombre'] = $row['producto_nombre'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
