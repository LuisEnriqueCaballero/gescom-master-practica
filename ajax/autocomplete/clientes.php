<?php
if (isset($_GET['term'])) {
    include '../is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
    include("../../config/db.php");
    include("../../config/conexion.php");
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {

        $fetch = mysqli_query($con, "select * from clientes where cliente_nombre like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' or cliente_documento like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50");

        /* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $id_cliente                     = $row['cliente_id'];
            $row_array['value']             = $row['cliente_documento']." | ".$row['cliente_nombre'];
            $row_array['id_cliente']        = $id_cliente;
            $row_array['cliente_nombre']    = $row['cliente_nombre'];
            $row_array['cliente_documento'] = $row['cliente_documento'];
            $row_array['cliente_email']     = $row['cliente_email'];
            $row_array['cliente_direccion'] = $row['cliente_direccion'];
            $row_array['cliente_telefono']  = $row['cliente_telefono'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
