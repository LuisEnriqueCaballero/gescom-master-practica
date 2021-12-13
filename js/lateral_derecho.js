$(document).ready(function(){
	load_lateral(1);
});
//Busca las categorias
function load_lateral(page){
	var q= $("#q").val();
	$("#ldng_lateral").fadeIn('slow');
	$.ajax({
		url:'../ajax/clientes_lateral.php?action=ajax&page='+page+'&q='+q,
  	beforeSend: function(objeto){
  		//$('#ldng_cat').html('<img src="../img/company/logotipo.png" width="150"><p><img src="../plantilla/images/load.gif" width="30"></p>');
    	//$('#ldng_cat').addClass('ajax-loader');
  	},
  	success:function(data){
    	$(".outer_div_lateral").html(data).fadeIn('slow');
    	$('#ldng_lateral').html('');
    	//$('#ldng_cat').removeClass('ajax-loader');
  	}
  })
}