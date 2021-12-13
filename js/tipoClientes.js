$(document).ready(function(){
	load(1);
});
//Busca las categorias
function load(page){
	var q= $("#q").val();
	$("#ldng_cat").fadeIn('slow');
	$.ajax({
		url:'../ajax/buscarTipoClientes.php?action=ajax&page='+page+'&q='+q,
  	beforeSend: function(objeto){
  		//$('#ldng_cat').html('<img src="../img/company/logotipo.png" width="150"><p><img src="../plantilla/images/load.gif" width="30"></p>');
    	//$('#ldng_cat').addClass('ajax-loader');
  	},
  	success:function(data){
    	$(".outer_div_cat").html(data).fadeIn('slow');
    	$('#ldng_cat').html('');
    	//$('#ldng_cat').removeClass('ajax-loader');
  	}
  })
}
$(document). prop('title', '.:: Tipo De Clientes | Prizma Technology ::.');
//Marcamos el menu lateral
$('#inicio').removeClass("active");
$('#caja').removeClass("active");
$('#pos').removeClass("active");
$('#cotizador').removeClass("active");
$('#eventos').removeClass("active");
//Personas
$('#personas').removeClass("active");
$('#clientes').removeClass("active");
$('#ulPersonas').removeClass("in");
$("#ulPersonas").attr("aria-expanded","false");
//Contabilidad
$('#contabilidad').addClass("active");
$('#tipoClientes').addClass("active");
$('#ulContabilidad').addClass("in");
$("#ulContabilidad").attr("aria-expanded","true");