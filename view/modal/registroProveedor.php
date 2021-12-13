<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
<form method="post" id="guardar_proveedor" name="guardar_proveedor" autocomplete="off" class="form-horizontal">
   <div class="modal fade" id="nuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content bg-white">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Proveedor</h5>
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
                       <label for="cliente_telefono">Tel&eacute;fono</label>
                       <input type="text" class="form-control input-sm" id="cliente_telefono" name="cliente_telefono" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Tel&eacute;fono">
                   </div>
                   <div class="form-group col-md-6">
                       <label for="cliente_email">E-Mail *</label>
                       <input type="email" class="form-control input-sm" id="cliente_email" name="cliente_email" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="E-Mail" required>
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