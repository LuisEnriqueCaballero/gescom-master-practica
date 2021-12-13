<?php
//Include database configuration file
include "../config/sunat.php";

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    //Get all state data
    $query = $db->query("SELECT * FROM familia_productos WHERE familia_idSegmento = ".$_POST['country_id']." ORDER BY familia_nombre ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">-- FAMILIA --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['familia_id'].'">'.$row['familia_nombre'].'</option>';
        }
    }else{
        echo '<option value="">-- FAMILIA NO ENCONTRADA --</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM clase_productos WHERE clase_idFamilia = ".$_POST['state_id']." ORDER BY clase_nombre ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">-- CLASE --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['clase_id'].'">'.$row['clase_nombre'].'</option>';
        }
    }else{
        echo '<option value="">-- CLASE NO ENCONTRADA --</option>';
    }
}

if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM prosunat WHERE prosunat_clase = ".$_POST['city_id']." ORDER BY prosunat_nombre ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">-- PRODUCTO --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['prosunat_id'].'">'.$row['prosunat_nombre'].'</option>';
        }
    }else{
        echo '<option value="">-- PRODUCTO NO ENCONTRADO --</option>';
    }
}

if(isset($_POST["product_id"]) && !empty($_POST["product_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM prosunat WHERE prosunat_id = ".$_POST['product_id']." ORDER BY prosunat_id ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '';
        while($row = $query->fetch_assoc()){ 
            echo $row['prosunat_codigo'];
        }
    }else{
        echo '';
    }
}
?>