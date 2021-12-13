<?php
//Include database configuration file
include "../config/sunat.php";

if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM prosunat WHERE prosunat_clase = ".$_POST['city_id']." ORDER BY prosunat_nombre ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<input type="text" class="form-control input-sm" name="producto_codigo" id="producto_codigo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Buscar c&oacute;digo UNSPSC" readonly required data-toggle="modal" data-target="#sunat">';
        while($row = $query->fetch_assoc()){ 
            echo '<input type="text" class="form-control input-sm" name="producto_codigo" id="producto_codigo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Buscar c&oacute;digo UNSPSC" readonly required data-toggle="modal" data-target="#sunat" value="'.$row['prosunat_codigo'].'">';
        }
    }else{
        echo '<input type="text" class="form-control input-sm" name="producto_codigo" id="producto_codigo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Buscar c&oacute;digo UNSPSC" readonly required data-toggle="modal" data-target="#sunat">';
    }
}
?>