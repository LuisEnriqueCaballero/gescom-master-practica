$(document). prop('title', '.:: Ajustar | Prizma Technology ::.');
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
$('#productos').removeClass("active");
$('#kardex').removeClass("active");
$('#ajustarInventario').addClass("active");
$('#ulAlmacen').addClass("in");
$("#ulAlmacen").attr("aria-expanded","true");