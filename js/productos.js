$(document).ready(function(){
  load(1);
});
//Busca las categorias
function load(page){
  var q = $("#q").val();
  var per_page = $("#per_page").val();
  var per_almacen = $("#per_almacen").val();
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarProductos.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page+'&per_almacen='+per_almacen,
    beforeSend: function(objeto){ },
    success:function(data){
      $(".outer_div_cat").html(data).fadeIn('slow');
      $('#ldng_cat').html('');
    }
  })
}
$(document). prop('title', '.:: Productos | Prizma Technology ::.');
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
$('#unidadMedidas').removeClass("active");
$('#productos').addClass("active");
$('#ulAlmacen').addClass("in");
$("#ulAlmacen").attr("aria-expanded","true");