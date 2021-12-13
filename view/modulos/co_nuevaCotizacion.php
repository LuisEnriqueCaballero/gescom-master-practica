<!-- Start Breadcrumbbar -->
<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
session_start();
require_once "../../config/general.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
include "../modal/buscarProductosVenta.php";
include "../modal/registroItem.php";
//include
//include "../modal/registroCliente.php";
$sql_empresa=mysqli_query($con,"select * from datosempresa");
$rw_tienda=mysqli_fetch_array($sql_empresa);

$datosEmpresa_id=$rw_tienda['datosEmpresa_id'];
$datosEmpresa_nombre=$rw_tienda['datosEmpresa_nombre'];
$datosEmpresa_ruc=$rw_tienda['datosEmpresa_ruc'];
$datosEmpresa_direccion=$rw_tienda['datosEmpresa_direccion'];
$datosEmpresa_correo=$rw_tienda['datosEmpresa_correo'];
$datosEmpresa_logo=$rw_tienda['datosEmpresa_logo'];

//$cambio = $_POST['cambio'];


?>
            <div class="content">
                <header class="page-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h1 class="separator">Nueva <span id="tipoDocumentoT">Cotizaci&oacute;n</span></h1>
                            <nav class="breadcrumb-wrapper" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <div class="button-list">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-primary active" onclick="cambiaCotizacion();">
                                                <input type="radio" name="options" checked> Cotizaci&oacute;n
                                            </label>

                                            <select class="form-control" id="tipoCambio" onchange="tc(this);">
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
                                        <div id="muestraTipoCambio"></div>
                                    </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
                <div class="page-content container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4" style="text-align: center;">
                                          <img src="../img/company/<?php echo $datosEmpresa_logo; ?>" style="width: 250px;">
                                        </div>
                                        <div class="col-md-4" style="text-align: center;">
                                          <strong><?php echo $datosEmpresa_nombre; ?></strong><br>
                                          RUC: <?php echo $datosEmpresa_ruc; ?><br>
                                          <?php echo $datosEmpresa_correo; ?>
                                        </div>
                                        <div class="col-md-4" style="text-align: center;">
                                            <div id="tituloSerie"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <form role="form" id="datos_factura">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label for="cliente_nombre1" class="col-sm-4 col-form-label">Cliente *</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" id="cliente_nombre1" class="form-control" placeholder="Buscar por documento o nombre" required  tabindex="2" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" >
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#nuevoCliente"><li class="la la-plus"></li></button>
                                                            </span>
                                                            <input id="id_cliente" name="id_cliente" type='hidden'>
                                                            <input type="hidden" name="tipoCambio" id="tc" value="115">
                                                            <input type="hidden" name="valorTipoCambio" id="vtc" value="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cliente_documento" class="col-sm-4 col-form-label">Documento </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" autocomplete="off" id="cliente_documento" name="cliente_documento" readonly="" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cliente_telefono" class="col-sm-4 col-form-label">Tel&eacute;fono </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" autocomplete="off" id="cliente_telefono" name="cliente_telefono" readonly="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-4" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="factura_folio">Folio:</label>
                                                            <div id="cambiaFolio"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="factura_correlativo">Correlativo:</label>
                                                            <div id="cambiaCorrelativo"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="factura_hora">Hora:</label>
                                                            <input type="time" class="form-control" id="factura_hora" name="factura_hora" value="<?php echo date('H:i:s') ?>">
                                                        </div>
                                                    </div>
                                                    <?php include "../modal/registroObservacionesBoleta.php"; ?>
                                                    <div id="tipoDocumento"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label for="factura_fecha" class="col-sm-4 col-form-label">Fecha *</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control" id="factura_fecha" name="factura_fecha" value="<?php echo date('Y-m-d') ?>" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="condiciones" class="col-sm-4 col-form-label">Condici&oacute;n Pago *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control input-sm condiciones" id="condiciones" name="condiciones" required>
                                                            <option value="1">Contado</option>
                                                            <option value="2">Cheque</option>
                                                            <option value="3">Transferencia bancaria</option>
                                                            <option value="4">Cr&eacute;dito</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="factura_fechaVencimiento" class="col-sm-4 col-form-label">Vencimiento *</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control" id="factura_fechaVencimiento" name="factura_fechaVencimiento">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="terminos" class="col-sm-4 col-form-label">T&eacute;rminos Pago *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control input-sm terminos" id="terminos" name="terminos" required>
                                                            <option value="10">10 D&iacute;as</option>
                                                            <option value="15">15 D&iacute;as</option>
                                                            <option value="20">20 D&iacute;as</option>
                                                            <option value="25">25 D&iacute;as</option>
                                                            <option value="30">30 D&iacute;as</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<button type="submit" id="guardar_factura" class="btn btn-danger" aria-haspopup="true" aria-expanded="false" style="position: fixed;z-index: 999;right:0px;height:50px;border:2px solid #000;top: 50%;">
                                            Procesar Venta
                                        </button>-->

                                        <div style="position: fixed;z-index: 999;right:0px;top: 45%; box-shadow: 2px 2px 10px #666; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                            <button type="submit" id="guardar_factura" class="btn btn-primary" aria-haspopup="true" aria-expanded="false" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-right-radius: 0px; border-top-left-radius: 10px;">
                                                Procesar Cotizaci&oacute;n
                                            </button>
                                            <br>
                                            <div class="btn btn-info" data-toggle="modal" data-target="#observaciones" style="width: 100%; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; cursor: pointer;">
                                                Observaciones
                                            </div>
                                            <br>
                                            <div class="btn btn-dark" data-toggle="modal" data-target="#buscar" style="width: 100%; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                                                Buscar &iacute;tem
                                            </div>
                                            <br>
                                            <div class="btn btn-secondary" data-toggle="modal" data-target="#nuevoItem" style="width: 100%; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 10px; cursor: pointer;">
                                                Nuevo &iacute;tem
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="resultados_ajaxf" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                                            <form role="form" id="barcode_form">
                                                <div class="form-group row">
                                                    <!--<label for="barcode_qty" class="col-md-1 control-label">Cant:</label>-->
                                                    <div class="col-md-1">
                                                        <input type="text" class="form-control" id="barcode_qty" value="1" autocomplete="off"style="border: 1px solid #232323; border-radius: 4px;">
                                                    </div>

                                                    <!--<label for="barcode" class="col-md-1  control-label">C&oacute;digo:</label>-->
                                                    <div class="col-md-3" align="left">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="barcode" autocomplete="off"  tabindex="1" autofocus="true" style="border: 1px solid #232323; border-top-left-radius: 4px; border-bottom-left-radius: 4px; border-right: 1px solid #fff;">
                                                            <span class="input-group-btn" style="border: 1px solid #232323; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-left: 1px solid #fff;">
                                                                <button type="submit" class="btn btn-secondary"><span class="la la-barcode"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-2">
                                                        <button type="button" accesskey="a" class="btn btn-secondary" data-toggle="modal" data-target="#buscar">
                                                            <span class="fa fa-search"></span> Buscar &iacute;tem
                                                        </button>
                                                    </div>-->
                                                    <!--<div class="col-md-2" style="float: right;">
                                                        <button type="button" accesskey="a" class="btn btn-secondary" data-toggle="modal" data-target="#nuevoItem">
                                                            <span class="fa fa-plus"></span> Nuevo &iacute;tem
                                                        </button>
                                                    </div>-->
                                                </div>
                                            </form>
                                        </div>
                                        <br><br>
                                        <div id="resultados" class='col-md-12'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" id="guardar_cliente" name="guardar_cliente" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Cliente</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
              <div id="resultados_ajax2"></div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="cliente_tipo">Tipo de documento *</label>
                     <select required id="cliente_tipo" name="cliente_tipo" class="form-control" onchange="getval(this);">
                        <option value="">SELECCIONAR</option>
                        <?php           
                           $tipo_cliente ="select * from sunat_tipocliente";
                           $row          =mysqli_query($con,$tipo_cliente);
                           while ($row4 = mysqli_fetch_array($row)) {
                              $sunat_tipoCliente_nombre = $row4["sunat_tipoCliente_nombre"];
                              $sunat_tipoCliente_id     = $row4["sunat_tipoCliente_id"];
                        ?>
                        <option value="<?php echo $sunat_tipoCliente_id;?>"><?php  echo $sunat_tipoCliente_nombre;?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="documento_colaborador">Documento</label>
                     <div class="input-group">
                         <input type="number" class="form-control input-sm" name="documento_colaborador" id="documento_colaborador" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Documento" required>
                         <div id="tipo_boton"></div>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="cliente_nombre">Nombres *</label>
                       <input type="text" class="form-control input-sm" id="cliente_nombre" name="cliente_nombre" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Apellidos y nombres" required>
                   </div>
                   <div class="form-group col-md-2">
                       <label for="cliente_departamento">Departamento</label>
                       <input type="text" class="form-control input-sm" id="cliente_departamento" name="cliente_departamento" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Departamento">
                   </div>
                   <div class="form-group col-md-2">
                       <label for="cliente_provincia">Provincia</label>
                       <input type="text" class="form-control input-sm" id="cliente_provincia" name="cliente_provincia" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Provincia">
                   </div>
                   <div class="form-group col-md-2">
                       <label for="cliente_distrito">Distrito</label>
                       <input type="text" class="form-control input-sm" id="cliente_distrito" name="cliente_distrito" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Distrito">
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="cliente_direccion">Domicilio *</label>
                       <input type="text" class="form-control input-sm" id="cliente_direccion" name="cliente_direccion" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Domicilio" required>
                   </div>
                   <div class="form-group col-md-6">
                       <label for="cliente_pais">Pa&iacute;s</label>
                       <input type="text" class="form-control input-sm" id="cliente_pais" name="cliente_pais" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Pa&iacute;s">
                   </div>
               </div>
               <div class="form-row">
                   
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="cliente_telefono">Tel&eacute;fono *</label>
                       <input type="text" class="form-control input-sm" id="cliente_telefono" name="cliente_telefono" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Tel&eacute;fono" required>
                   </div>
                   <div class="form-group col-md-6">
                       <label for="cliente_email">E-Mail</label>
                       <input type="email" class="form-control input-sm" id="cliente_email" name="cliente_email" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="E-Mail">
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-group col-md-6">
                       <label for="cliente_contacto">Contacto</label>
                       <input type="text" class="form-control input-sm" id="cliente_contacto" name="cliente_contacto" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Contacto">
                   </div>
                   <div class="form-group col-md-6">
                       <label for="cliente_cargo">Cargo</label>
                       <input type="text" class="form-control input-sm" id="cliente_cargo" name="cliente_cargo" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Cargo">
                   </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary" id="guardar_datos">Aceptar</button>
            </div>
         </div>
      </div>
   </div>
</form>
<script>
   function getval(sel)
  {
   if(sel.value==''){
      toastr.error("Seleccionar un tipo de documento","Oopss!");
      $("#tipo_boton").html('');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','Documento');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", false);
      $('#cliente_pais').val('');
   }
   if(sel.value==1){
      //toastr.error("Seleccionar un tipo de documento","Oopss!");
      $("#tipo_boton").html('');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','Documento');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", false);
      $('#cliente_pais').val('');
      $('#documento_colaborador').focus();
   }
   if(sel.value==2){
      //toastr.error("Seleccionar un tipo de documento","Oopss!");
      $("#tipo_boton").html('<div id="botoncitoDNI" class="input-group-addon btn btn-primary"><i class="nohidden1"></i></div>');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','DNI');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", true);
      $('#cliente_pais').val('PERU');
      $('#documento_colaborador').focus();

      $(function(){
         $('.nohidden1').html('<i class="la la-search" style="color: #ffff;"></i>');
         $('.nohidden1').attr("disabled", true);
         $('#botoncitoDNI').on('click', function(){
           var documento_colaborador = $('#documento_colaborador').val();
           var url = '../ajax/consultas/reniecColaborador.php';
           $('.nohidden1').html('<img src="../img/company/load1.svg" width="20px">');
           $.ajax({
             type:'POST',
             url:url,
             data:'documento_colaborador='+documento_colaborador,
             success: function(datos_dni){
               $('.nohidden1').html('<i class="la la-search" style="color: #ffff;"></i');
               $('.nohidden1').attr("disabled", false);
               $('#cliente_telefono').focus();
               var datos = eval(datos_dni);
               var nada ='nada';
               if(datos_dni != nada)
                {
                  $('#numero_dni').text(datos[0]);
                  $('#cliente_nombre').val(datos[1]);
                  $('#estado_del_contribuyente').val(datos[2]);
                  $('#condicion_de_domicilio').val(datos[3]);
                  $('#ubgclienteruc').val(datos[4]);
                  $('#tipo_de_via').val(datos[5]);
                  $('#nombre_de_via').val(datos[6]);
                  $('#codigo_de_zona').val(datos[7]);
                  $('#numero').val(datos[8]);
                  $('#interior').val(datos[9]);
                  $('#lote').val(datos[10]);
                  $('#dpto').val(datos[11]);
                  $('#manzana').val(datos[12]);
                  $('#kilometro').val(datos[13]);
                  $('#cliente_departamento').val('-');
                  $('#cliente_provincia').val('-');
                  $('#cliente_distrito').val('-');
                  $('#cliente_direccion').val('-');
                  $('#direcclienteruc').val(datos[18]);
                  $('#ultima_actualizacion').val(datos[19]);
                  $('#informacion_resultado').val(datos[20]);
                  $('#apellido_paterno').val(datos[21]);
                  $('#apellido_materno').val(datos[22]);
                  $('#nombres').val(datos[23]);
                  $('#nombres_completos').val(datos[24]);
                //}
               //if(datos[0]==nada){
                 //alert('DNI no válido o no registrado');
               } if(datos[24] == '  ') {
                 //alert('DNI no válido o no registrado');
                 toastr.warning("No pudimos encontrar el documento...","Aviso!");
                 $("#documento_colaborador").val('');
                 $("#cliente_nombre").val('');
                 $("#cliente_departamento").val('');
                 $("#cliente_provincia").val('');
                 $("#cliente_distrito").val('');
                 $("#cliente_direccion").val('');
                 $('#documento_colaborador').focus();
               }   
            }
           });
         return false;
         });
      });
   }
   if(sel.value==3){
      //toastr.error("Seleccionar un tipo de documento","Aviso!");
      $("#tipo_boton").html('');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','Carnet de extranjeria');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", false);
      $('#cliente_pais').val('');
      $('#documento_colaborador').focus();
   }
   if(sel.value==4){
      //toastr.error("Seleccionar un tipo de documento","Aviso!");
      $("#tipo_boton").html('<div id="botoncitoRUC" class="input-group-addon btn btn-primary"><i class="nohidden1"></i></div>');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','RUC');
      $('#cliente_nombre').attr('placeholder','Razon Social');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", true);
      $('#cliente_pais').val('PERU');
      $('#documento_colaborador').focus();

      $(function(){
         $('.nohidden1').html('<i class="la la-search" style="color: #ffff;"></i>');
         $('#botoncitoRUC').on('click', function(){
           var documento_colaborador = $('#documento_colaborador').val();
           var url = '../ajax/consultas/sunatColaborador.php';
           $('.nohidden1').html('<img src="../img/company/load1.svg" width="20px">');
           $.ajax({
             type:'POST',
             url:url,
             data:'documento_colaborador='+documento_colaborador,
             success: function(datos_ruc){
               $('.nohidden1').html('<i class="la la-search" style="color: #ffff;"></i');
               $('.nohidden1').attr("disabled", false);
               //$('#cliente_telefono').focus();
               var datos = eval(datos_ruc);
               var nada ='nada';
               if(datos_ruc != nada){
                 $('#numero_ruc').text(datos[0]);
                 $('#cliente_nombre').val(datos[1]);
                 $('#estado_del_contribuyente').val(datos[2]);
                 $('#condicion_de_domicilio').val(datos[3]);
                 $('#ubgclienteruc').val(datos[4]);
                 $('#tipo_de_via').val(datos[5]);
                 $('#nombre_de_via').val(datos[6]);
                 $('#codigo_de_zona').val(datos[7]);
                 $('#numero').val(datos[8]);
                 $('#interior').val(datos[9]);
                 $('#lote').val(datos[10]);
                 $('#dpto').val(datos[11]);
                 $('#manzana').val(datos[12]);
                 $('#kilometro').val(datos[13]);
                 if (datos[14] == '') {
                    $('#cliente_departamento').focus();
                 }
                 if (datos[14] != '') {
                    $('#cliente_telefono').focus();
                 }
                 $('#cliente_departamento').val(datos[14]);
                 $('#cliente_provincia').val(datos[15]);
                 $('#cliente_distrito').val(datos[16]);
                 $('#cliente_direccion').val(datos[17]);
                 $('#direcclienteruc').val(datos[18]);
                 $('#ultima_actualizacion').val(datos[19]);
               } if(datos[0] == ''){
                 //alert('RUC no válido o no registrado');
                 toastr.warning("No pudimos encontrar el documento...","Aviso!");
                 $("#documento_colaborador").val('');
                 $('#documento_colaborador').focus();
               }   
             }
           });
           return false;
         });
       });
   }
   if(sel.value==5){
      //toastr.error("Seleccionar un tipo de documento","Aviso!");
      $("#tipo_boton").html('');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','Pasaporte');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", false);
      $('#cliente_pais').val('');
      $('#documento_colaborador').focus();
   }
   if(sel.value==6){
      //toastr.error("Seleccionar un tipo de documento","Oopss!");
      $("#tipo_boton").html('');
      $("#documento_colaborador").val('');
      $("#cliente_nombre").val('');
      $("#cliente_direccion").val('');
      $('#documento_colaborador').attr('placeholder','Cedula');
      $('#cliente_nombre').attr('placeholder','Apellidos y nombres');
      $('#cliente_direccion').attr('placeholder','Domicilio');
      $('#cliente_departamento').val('');
      $('#cliente_provincia').val('');
      $('#cliente_distrito').val('');
      $('#cliente_direccion').val('');
      $('#cliente_pais').attr("readonly", false);
      $('#cliente_pais').val('');
      $('#documento_colaborador').focus();
   }
  }

  
</script>
            <!-- End Contentbar -->
<script src="../js/nuevaCotizacion.js"></script>
<script src="../js/ventanaCentrada.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script>
function tc(sel)
{
    if(sel.value==115){
        //toastr.error("Seleccionar almac&eacute;n","Oopss!");
        $("#muestraTipoCambio").html('<input type="hidden" name="valorTipoCambio" class="form-control" value="3.64">');
        $("#vtc").val('0.00');
        $("#tc").val('115');
    }
    if(sel.value==151){
        //toastr.success("Almac&eacute;n seleccionado","Bien hecho!");
        $("#muestraTipoCambio").html('<input type="text" name="valorTipoCambio" class="form-control" value="3.64">');
        $("#vtc").val('3.64');
        $("#tc").val('151');


    }
}
//Registra
$("#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevoCliente.php",
    data: parametros,
    beforeSend: function(objeto){ },
    success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').html('Aceptar');
      $('#guardar_datos').attr("disabled", false);
      load(1);
      $("#guardar_cliente")[0].reset();
      $("#cliente_tipo").focus();
    }
  });
  event.preventDefault();
})
//
$("#datos_factura").submit(function(event) {
    $('#guardar_factura').attr("disabled", true);
    $('#guardar_factura').html('<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...');
    var id_cliente = $("#id_cliente").val();
    //var resibido = $("#resibido").val();
    /*if (isNaN(resibido)) {
        //$.Notification.notify('error','bottom center','NOTIFICACIÓN', 'EL DATO NO ES VALIDO, INTENTAR DE NUEVO')
        $("#resibido").focus();
        return false;
    }*/
    if (id_cliente == "") {
        //$.Notification.notify('warning','bottom center','NOTIFICACIÓN', 'DEBE SELECCIONAR UN CLIENTE VALIDO')
        toastr['warning']('Seleccionar un cliente v&aacute;lido', 'Aviso!');
        $("#cliente_nombre1").focus();
        $('#guardar_factura').html('Procesar Cotizaci&oacute;n');
        $('#guardar_factura').attr("disabled", false);
        return false;
    }
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../ajax/nuevoCotizacion.php",
        data: parametros,
        beforeSend: function(objeto) {
            //$("#resultados_ajaxf").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
            $("#resultados_ajaxf").html(datos);
            $('#guardar_factura').html('Procesar Cotizaci&oacute;n');
            $('#guardar_factura').attr("disabled", false);
            $("#datos_factura")[0].reset(); //Recet al formilario de el cliente
            $("#barcode_form")[0].reset(); // Recet al formulario de la fatura
            $("#resultados").load("../ajax/agregarTmpCotizaciones.php"); // carga los datos nuevamente
            $("#barcode").focus();

            //cambiaBoleta();
            $("#cambiaCorrelativo").load('../ajax/documentos/cambiaCotizacion1.php');
            $("#tituloSerie").load("../ajax/cargaTituloSerie2.php");

            $("#cliente_nombre1").val("");
            $("#id_cliente").val("");
            $("#cliente_documento").val("");
            $("#cliente_telefono").val("");
            $("#cliente_direccion").val("");

            $("#cliente_nombre1").focus();

            load(1);
            //$("#cambiaCorrelativo").load();
            //$("#tituloSerie").load();
        }
    });
    event.preventDefault();
})
</script>
<script>
function recargar() {
    $("#resultados").load("../ajax/agregarTmpCotizaciones.php");
    $("#cambiaCorrelativo").load('../ajax/documentos/cambiaCotizacion1.php');
    $("#tituloSerie").load("../ajax/cargaTituloSerie2.php");
}
</script>
<script>
// print order function
function imprimir_facturas3(id_factura){
    VentanaCentrada('../view/pdf/documentos/ticket_cot.php?comp='+id_factura,'Factura','','1024','768','true');
}
</script>
<script>
// print order function
function imprimir_facturas2(id_factura){
    VentanaCentrada('../view/pdf/documentos/a4_cot.php?comp='+id_factura,'Factura','','1024','768','true');
}
</script>