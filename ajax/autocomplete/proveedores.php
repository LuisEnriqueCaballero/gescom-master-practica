<?php
if (isset($_GET['term'])) {
    include '../is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../../config/db.php");
    include("../../config/conexion.php");
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {

        $fetch = mysqli_query($con, "select * from proveedores where proveedor_nombre like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' or proveedor_documento like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50");

        /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $id_cliente                       = $row['proveedor_id'];
            $row_array['value']               = $row['proveedor_documento']." | ".$row['proveedor_nombre'];
            $row_array['proveedor_id']          = $id_cliente;
            $row_array['proveedor_nombre']    = $row['proveedor_nombre'];
            $row_array['proveedor_documento'] = $row['proveedor_documento'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
