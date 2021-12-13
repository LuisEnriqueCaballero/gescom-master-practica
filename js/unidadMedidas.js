//Busca los datos
$(document).ready(function(){
  load(1);
});
function load(page){
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarUnd.php',
    beforeSend: function(objeto){ },
    success:function(data){
      $(".outer_div_cat").html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    }
  })
}
$(document). prop('title', '.:: Unidad Medidas | Prizma Technology ::.');
//Marcamos el menu lateral
$('#inicio').removeClass("active");
$('#caja').removeClass("active");
$('#pos').removeClass("active");
$('#cotizador').removeClass("active");
$('#eventos').removeClass("active");
$('#personas').removeClass("active");
$('#clientes').removeClass("active");
$('#ulPersonas').removeClass("in");
$("#ulPersonas").attr("aria-expanded","false");

$('#almacen').addClass("active");
$('#marcas').removeClass("active");
$('#categorias').removeClass("active");
$('#segmentos').removeClass("active");
$('#familias').removeClass("active");
$('#clases').removeClass("active");
$('#unidadMedidas').addClass("active");
$('#productos').removeClass("active");
$('#ulAlmacen').addClass("in");
$("#ulAlmacen").attr("aria-expanded","true");