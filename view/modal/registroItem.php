<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
//session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
$almacen = $_SESSION['almacen'];
?>
<form method="post" id="guardar_item" name="guardar_item" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Item</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="row">
                   <div class="col-md-6">
                       <label for="producto_codigoBarras">C&oacute;digo Barras *</label>
                       <div id="cod_resultado"></div>
                   </div>
                   <div class="col-md-6">
                       <label for="producto_nombre">Nombre *</label>
                       <input type="text" class="form-control input-sm" id="producto_nombre" name="producto_nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre" required>
                   </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                       <label for="producto_descripcion">Descripci&oacute;n</label>
                       <input type="text" class="form-control input-sm" id="producto_descripcion" name="producto_descripcion" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Descripci&oacute;n">
                   </div>
                  <div class="col-md-6">
                     <label for="producto_codigo" style="color: red;">C&oacute;digo Producto SUNAT *</label>
                     <div class="input-group">
                         <input type="text" class="form-control input-sm" name="producto_codigo" id="producto_codigo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Buscar c&oacute;digo UNSPSC" readonly required data-toggle='modal' data-target='#sunat'>
                         <div class="input-group-addon btn btn-primary" data-toggle='modal' data-target='#sunat'><i class="fa fa-search" style="color: white;"></i></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                   
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <label for="producto_idCategoria">Categor&iacute;a *</label>
                       <div class="input-group">
                        <div id="cargaCategoriaAjax"></div>
                        <div class="input-group-addon btn btn-primary" data-toggle='modal' data-target='#nuevoCategoria'><i class="fa fa-plus" style="color: white;"></i></div>
                     </div>
                   </div>
                   <div class="col-md-6">
                      <label for="producto_idMarca">Marca *</label>

                      <div class="input-group">
                        <div id="cargaMarcaAjax"></div>
                        <div class="input-group-addon btn btn-primary" data-toggle='modal' data-target='#nuevoMarca'><i class="fa fa-plus" style="color: white;"></i></div>
                     </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-6">
                       <label for="producto_idUnidadMedida">Unidad Medida *</label>
                       <select name="producto_idUnidadMedida" id="producto_idUnidadMedida" class="form-control" required>
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
                       <label for="producto_idProveedor">Proveedor *</label>
                       <select name="producto_idProveedor" id="producto_idProveedor" class="form-control" required>
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
                       <label for="producto_afectacion">Tipo Afectaci&oacute;n *</label>
                       <select name="producto_afectacion" id="producto_afectacion" class="form-control" required>
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
                       <label for="producto_monVenta">Moneda *</label>
                       <select name="producto_monVenta" id="producto_monVenta" class="form-control" required>
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
                       <label for="producto_costo">Costo *</label>
                       <input type="text" class="form-control input-sm" id="producto_costo" name="producto_costo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Costo" required>
                   </div>
                   <div class="col-md-3">
                       <label for="producto_precio">Precio *</label>
                       <input type="text" class="form-control input-sm" id="producto_precio" name="producto_precio" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Precio" required>
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-2">
                       <label for="producto_stock">Stock Inicial *</label>
                       <input type="text" class="form-control input-sm" id="producto_stock" name="producto_stock" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Stock Inicial" required>
                   </div>
                   <div class="col-md-2">
                       <label for="producto_minimo">Stock M&iacute;nimo *</label>
                       <input type="text" class="form-control input-sm" id="producto_minimo" name="producto_minimo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Stock M&iacute;nimo" required>
                   </div>
                   <div class="col-md-2">
                       <label for="producto_icbper">¿ICBPER? *</label>
                       <select name="producto_icbper" id="producto_icbper" class="form-control" required>
                          <option value="1">NO</option>
                          <option value="2">S&Iacute;</option>
                      </select>
                   </div>
                   <div class="col-md-3">
                       <label for="producto_fechaVencimiento1">¿Caduca? *</label>
                       <select name="producto_fechaVencimiento1" id="producto_fechaVencimiento1" class="form-control" onchange="showFv(this)" required>
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
               <button type="submit" class="btn btn-primary" id="guardar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
   

   <div class="modal fade" id="sunat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="box-shadow: 2px 2px 10px #666">
          <div class="modal-content bg-white">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">C&oacute;digo UNSPSC</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                   <div class="col-md-12">
                       <label for="cliente_telefono">Segmento *</label>
                       <select name="producto_idSegmento" id="producto_idSegmento" class="select21 form-control" style="width: 100%;" required>
                          <option value="">-- SEGMENTO --</option>
                          <?php           
                             $sql_segmento ="select * from segmento_producto";
                             $row          =mysqli_query($con,$sql_segmento);
                             while ($row4 = mysqli_fetch_array($row)) {
                                $segmento_nombre = $row4["segmento_nombre"];
                                $segmento_id     = $row4["segmento_id"];
                          ?>
                          <option value="<?php echo $segmento_id;?>"><?php  echo $segmento_nombre;?></option>

                          <?php } ?>
                      </select>
                   </div>

                   <div class="col-md-12">
                       <label for="producto_idFamilia">Familia *</label>
                       <select name="producto_idFamilia" id="producto_idFamilia" class="select21 form-control" style="width: 100%;" required>
                          <option value="">-- PRIMERO SELECCIONA UN SEGMENTO --</option>
                      </select>
                   </div>
                </div>

                <div class="row">
                   <div class="col-md-12">
                       <label for="producto_idClase">Clase *</label>
                       <select name="producto_idClase" id="producto_idClase" class="select21 form-control" style="width: 100%;" required>
                          <option value="">-- PRIMERO SELECCIONA UNA FAMILIA --</option>
                      </select>
                   </div>

                   <div class="col-md-12">
                       <label for="producto_idProducto">Producto *</label>
                        <select name="producto_idProducto" id="producto_idProducto" class="select21 form-control" style="width: 100%;" required>
                            <option value="">-- PRIMERO SELECCIONA UNA CLASE --</option>
                        </select>
                   </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">De acuerdo</button>
              </div>
          </div>
      </div>
  </div>
</form>
<script>
  //$('.select2-single').select2();
</script>
<script>
$(document).ready(function(){
  $("#cod_resultado").load("../ajax/incrementaCodProducto.php");
  $('#cargaMarcaAjax').load('../ajax/ajaxMarcas.php');
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
    });
    
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