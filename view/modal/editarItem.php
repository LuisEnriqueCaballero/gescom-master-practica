<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
 $('#mod_marca').val(nom_marca);
  $('#mod_descripcion').val(desc_marca);
  $('#mod_idEstablecimiento').val(id);
---------------------------*/
/* Connect To Database*/
//session_start();
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="editar_item" name="editar_item" autocomplete="off" class="form-horizontal form-validate">
   <div class="modal fade" id="editarItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Editar Item</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
                  <input type="hidden" name="mod_idItem" id="mod_idItem">
                  
               <div class="row">
                   <div class="col-md-6">
                       <label for="mod_codbarras">C&oacute;digo Barras *</label>
                       <input type="text" class="form-control input-sm" id="modprod_codbarras" name="mod_codbarras" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="000000" disabled>
                   </div>
                   <div class="col-md-6">
                       <label for="mod_nombre">Nombre *</label>
                       <input type="text" class="form-control input-sm" id="modprod_nombre" name="mod_nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre" required>
                   </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                       <label for="modprod_descripcion">Descripci&oacute;n</label>
                       <input type="text" class="form-control input-sm" id="modprod_descripcion" name="modprod_descripcion" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Descripci&oacute;n">
                   </div>
                  <div class="col-md-6">
                     <label for="modprod_codsunat" style="color: red;">C&oacute;digo Producto SUNAT *</label>
                     <div class="input-group">
                         <input type="text" class="form-control input-sm" name="modprod_codsunat" id="modprod_codsunat" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Buscar c&oacute;digo UNSPSC" readonly required data-toggle='modal' data-target='#sunat'>
                         <div class="input-group-addon btn btn-primary" data-toggle='modal' data-target='#sunat'><i class="fa fa-search" style="color: white;"></i></div>
                     </div>
                  </div>
               </div>
               
               <div class="row">
                   <div class="col-md-6">
                       <label for="modprod_categoria">Categor&iacute;a *</label>
                       <select name="modprod_categoria" id="modprod_categoria" class="form-control" required>
                          <?php
                             $sql_segmento ="select * from categorias";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $categoria_nombre = $row4["categoria_nombre"];
                                $categoria_id     = $row4["categoria_id"];
                          ?>
                          <option value="<?php echo $categoria_id;?>"><?php  echo $categoria_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
                   <div class="col-md-6">
                      <label for="modprod_marca">Marca *</label>
                      <select name="modprod_marca" id="modprod_marca" class="form-control" required>
                          <?php
                             $sql_segmento ="select * from marcas";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $categoria_nombre = $row4["marca_nombre"];
                                $categoria_id     = $row4["marca_id"];
                          ?>
                          <option value="<?php echo $categoria_id;?>"><?php  echo $categoria_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <label for="modprod_unidadMedida">Unidad Medida *</label>
                       <select name="modprod_unidadMedida" id="modprod_unidadMedida" class="form-control" required>
                          <?php
                             $sql_segmento ="select * from unidadmedida";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $unidadMedida_nombre = $row4["unidadMedida_nombre"];
                                $unidadMedida_id     = $row4["unidadMedida_id"];
                          ?>
                          <option value="<?php echo $unidadMedida_id;?>"><?php  echo $unidadMedida_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
                   <div class="col-md-6">
                       <label for="modprod_proveedor">Proveedor *</label>
                       <select name="modprod_proveedor" id="modprod_proveedor" class="form-control" required>
                          <?php $tienda = $_SESSION['tienda'];
                             $sql_segmento ="select * from proveedores where (proveedor_sucursal='$tienda' or proveedor_sucursal=0) order by proveedor_id asc";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $proveedor_nombre = $row4["proveedor_nombre"];
                                $proveedor_id     = $row4["proveedor_id"];
                          ?>
                          <option value="<?php echo $proveedor_id;?>"><?php  echo $proveedor_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-3">
                       <label for="modprod_afectacion">Tipo Afectaci&oacute;n *</label>
                       <select name="modprod_afectacion" id="modprod_afectacion" class="form-control" required>
                          <?php
                             $sql_segmento ="select * from tipo_afectacion where tipoafectacion_id<= 18";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $tipoafectacion_nombre = $row4["tipoafectacion_nombre"];
                                $tipoafectacion_id     = $row4["tipoafectacion_id"];
                          ?>
                          <option value="<?php echo $tipoafectacion_id;?>"><?php  echo $tipoafectacion_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
                   <div class="col-md-3">
                       <label for="modprod_moneda">Moneda *</label>
                       <select name="modprod_moneda" id="modprod_moneda" class="form-control" required>
                          <?php
                             $sql_segmento ="select * from monedas where (moneda_id=115 or moneda_id=151)";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $moneda_nombre = $row4["moneda_nombre"];
                                $moneda_id     = $row4["moneda_id"];
                          ?>
                          <option value="<?php echo $moneda_id;?>"><?php  echo $moneda_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>
                   <div class="col-md-3">
                       <label for="modprod_costo">Costo *</label>
                       <input type="text" class="form-control input-sm" id="modprod_costo" name="modprod_costo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Costo" required>
                   </div>
                   <div class="col-md-3">
                       <label for="modprod_precio">Precio *</label>
                       <input type="text" class="form-control input-sm" id="modprod_precio" name="modprod_precio" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Precio" required>
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-2">
                       <label for="modprod_stock">Stock Inicial *</label>
                       <input type="text" class="form-control input-sm" id="modprod_stock" name="modprod_stock" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Stock Inicial" required>
                   </div>
                   <div class="col-md-2">
                       <label for="modprod_stockmin">Stock M&iacute;n *</label>
                       <input type="text" class="form-control input-sm" id="modprod_stockmin" name="modprod_stockmin" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Stock M&iacute;nimo" required>
                   </div>
                   <div class="col-md-2">
                       <label for="modprod_icbper">¿ICBPER? *</label>
                       <select name="modprod_icbper" id="modprod_icbper" class="form-control" required>
                          <option value="1">NO</option>
                          <option value="2">S&Iacute;</option>
                      </select>
                   </div>
                   <div class="col-md-3">
                       <label for="modprod_vencimiento">¿Caduca? *</label>
                       <select name="modprod_vencimiento" id="modprod_vencimiento" class="form-control" onchange="showFv(this)" required>
                          <option value="">-- SELECCIONA --</option>
                          <option value="1">NO</option>
                          <option value="2">S&Iacute;</option>
                      </select>
                   </div>
                   <div id="carga_fecha" class="col-md-3"></div>
                   <input type="hidden" name="almacenP" id="almacenP" value="<?php echo $almacen; ?>" class="hidden">
               </div>

            </div>
            
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary" id="actualizar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>
<script>
$(document).ready(function(){
  //$("#cod_resultado").load("../ajax/incrementaCodProducto.php");
  /*$('#cargaMarcaAjax').load('../ajax/ajaxMarcas.php');
  $('#cargaCategoriaAjax').load('../ajax/ajaxCategorias.php');
    $('#producto_idSegmento').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'../ajax/ajaxDate.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#producto_idFamilia').html(html);
                    $('#producto_idClase').html('<option value="">-- PRIMERO SELECCIONA UNA FAMILIA --</option>');
                    $('#producto_idProducto').html('<option value="">-- PRIMERO SELECCIONA UNA CLASE --</option>'); 
                    $('#producto_codigo').val('');
                }
            }); 
        }else{
            $('#producto_idFamilia').html('<option value="">-- PRIMERO SELECCIONA UN SEGMENTO --</option>');
            $('#producto_idClase').html('<option value="">-- PRIMERO SELECCIONA UNA FAMILIA --</option>');
            $('#producto_idProducto').html('<option value="">-- PRIMERO SELECCIONA UNA CLASE --</option>');
            $('#producto_codigo').val('');
        }
    });*/
    
    $('#producto_idFamilia').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'../ajax/ajaxDate.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#producto_idClase').html(html);
                }
            }); 
        }else{
            $('#producto_idClase').html('<option value="">-- PRIMERO SELECCIONA UNA FAMILIA --</option>'); 
            $('#producto_idProducto').html('<option value="">-- PRIMERO SELECCIONA UNA CLASE --</option>');
            $('#producto_codigo').val('');
        }
    });

    $('#producto_idClase').on('change',function(){
        var cityID = $(this).val();
        if(cityID){
            $.ajax({
                type:'POST',
                url:'../ajax/ajaxDate.php',
                data:'city_id='+cityID,
                success:function(html){
                    $('#producto_idProducto').html(html);
                }
            }); 
        }else{
            $('#producto_idProducto').html('<option value="">-- PRIMERO SELECCIONA UNA CLASE --</option>'); 
            $('#producto_codigo').val('');
        }
    });

    $('#producto_idProducto').on('change',function(){
        var productID = $(this).val();
        if(productID){
            $.ajax({
                type:'POST',
                url:'../ajax/ajaxDate.php',
                data:'product_id='+productID,
                success:function(html){
                    $('#producto_codigo').val(html);
                }
            }); 
        }else{
            $('#producto_codigo').val(''); 
        }
    });
});
</script>

<script>
  function showFv(select){
    if(select.value==''){
      $("#carga_fecha").html('');
    }
    if(select.value==1){
      $("#carga_fecha").html('<label for="producto_fechaVencimiento">F. Vencimiento *</label><input type="hidden" class="form-control input-sm" id="producto_fechaVencimiento" name="producto_fechaVencimiento" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" value="0000-00-00">');
    }
    if(select.value==2){
      $("#carga_fecha").html('<label for="producto_fechaVencimiento">F. Vencimiento *</label><input type="date" class="form-control input-sm" id="producto_fechaVencimiento" name="producto_fechaVencimiento" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">');
    }
  }
</script>

<script>
  //Registra
  $("#guardar_item" ).submit(function( event ) {
    $('#guardar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
    $('#guardar_datos').attr("disabled", true);
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "../ajax/nuevoItem.php",
      data: parametros,
      beforeSend: function(objeto){ },
      success: function(datos){
        $("#resultados_ajax").html(datos);
        $('#guardar_datos').html('Aceptar');
        $('#guardar_datos').attr("disabled", false);
        $("#cod_resultado").load("../ajax/incrementaCodProducto.php");
        load(1);
        $("#guardar_item")[0].reset();
        $("#producto_codigoBarras").focus();
      }
    });
    event.preventDefault();
  })

  //Registra
$("#guardar_marca" ).submit(function( event ) {
  $('#guardar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevoMarca.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr("disabled", false);
      $('#cargaMarcaAjax').load('../ajax/ajaxMarcas.php');
      $("#guardar_marca")[0].reset();
      $("#nom_marca").focus();
    }
  });
  event.preventDefault();
})

//Registra
$("#guardar_categoria" ).submit(function( event ) {
  $('#guardar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevoCategoria.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr("disabled", false);
      $('#cargaCategoriaAjax').load('../ajax/ajaxCategorias.php');
      $("#guardar_categoria")[0].reset();
      $("#nom_categoria").focus();
    }
  });
  event.preventDefault();
})
</script>
<script>
$('.select21').select2({
  placeholder: 'Selecciona una opcion',
  width: 'resolve',
  dropdownParent: $("#sunat")
  //theme: "classic"
});
//
function PasarCodigo() {
    document.getElementById("producto_codigo").value = document.getElementById("producto_codigoBarras").value;
}
</script>