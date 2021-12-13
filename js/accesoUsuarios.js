$(document). prop('title', '.:: Almacenes | Prizma Technology ::.');

$(document).ready(function(){
  load(1);
});
//Busca las categorias
function load(page){
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarAccesoUsuario.php',
    beforeSend: function(objeto){ },
    success:function(data){
      $(".outer_div_cat").html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    }
  })
}
//Registra
$('#guardar_accesoUsuario').submit(function (event) {
    $('#guardar_datos').html(
      '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
    );
    $('#guardar_datos').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/nuevoAccesoAlmacen.php',
      data: parametros,
      beforeSend: function (objeto) {},
      success: function (datos) {
        $('#resultados_ajax').html(datos);
        $('#guardar_datos').html('Aceptar');
        $('#guardar_datos').attr('disabled', false);
        load(1);
        $('#guardar_accesoUsuario')[0].reset();
        $('#nombre_almacen').focus();
      },
    });
    event.preventDefault();
  });
//guardar menu
$('#guardar_grupomenu').submit(function (event) {
  $('#array_menu').html(
    '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
  );
  $('#array_menu').attr('disabled', true);
  var parametros = $(this).serialize();
var checkboxes=document.querySelectorAll('.checkbox');
var listArray=[];
var listArraay=[1,2,3,4,5,6];
checkboxes.forEach((e)=>{
  if(e.checked==true){
    listArray.push(e.value);
    //console.log(e.value);
  }
})
//console.log(listArray);

console.log(listArray);
event.preventDefault();
});
var idgrupo=0;
function carga_idgrupo(id){
  idgrupo=id;
  alert(id);
  $('#mod_idgrupo').val(id);
  
  /*$.ajax({
    data: {"idgrupo" : id},
    url: "../ajax/cargaMenuGrupoUsuario.php",
    type: "post",
    success:  function (response) {
      alert(response);
    }
  });*/

}
  //Obtiene los datos en el modal
function obtener_datos(id) {
    //alert('id es:'+id);
    var nom_accesoUsuario= $('#nom_accesoUsuario' + id).val();
    var id_accesoUsuario = $('#id_accesoUsuario' + id).val();

    //alert('e:'+nom_establecimiento);
    $('#mod_idAccesoUsuario').val(id_accesoUsuario);
    $('#mod_nombreAcceso ').val(nom_accesoUsuario);
  }
  //Edita
$('#editar_accesoUsuario').submit(function (event) {
    $('#actualizar_datos').html(
      '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
    );
    $('#actualizar_datos').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/editarAccesoUsuario.php',
      data: parametros,
      beforeSend: function (objeto) {},
      success: function (datos) {
        $('#resultados_ajax2').html(datos);
        $('#actualizar_datos').html('Aceptar');
        $('#actualizar_datos').attr('disabled', false);
        load(1);
        loadS(1);
        //console.log(datos);
      },
    });
    event.preventDefault();
  });
  //Elimina
$('#eliminar_accesoUsuario').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data('id'); // Extraer la información de atributos de datos
    var modal = $(this);
    modal.find('#id_accesoUsuario').val(id);
  });
  $('#eliminarDatos').submit(function (event) {
    $('#eliminar').html(
      '<img src="../img/company/load1.svg" style="width: 20px;"> &nbsp; Verificando...'
    );
    $('#eliminar').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/eliminarAccesoUsuario.php',
      data: parametros,
      beforeSend: function (objeto) {},
      success: function (datos) {
        $('.datos_ajax_delete').html(datos);
        $('.datos_ajax_delete').html('');
        $('.datos_ajax_delete').removeClass('ajax-loader');
        $('#eliminar').html('S&iacute;, continuar');
        $('#eliminar').attr('disabled', false);
        $('#eliminar_accesoUsuario').modal('hide');
        load(1);
        //console.log(datos);
      },
    });
    event.preventDefault();
  });