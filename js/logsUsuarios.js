$(document).ready(function(){
  load(1);
});
//Busca las categorias
function load(page){
  var q = $("#q").val();
  var per_page = $("#per_page").val();
  $("#ldng_cat").fadeIn('slow');
  $.ajax({
    url:'../ajax/buscarLogsUsuarios.php?action=ajax&page='+page+'&q='+q+'&per_page='+per_page,
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
$(document). prop('title', '.:: Logs Usuarios | Prizma Technology ::.');
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

$('#configuraciones').addClass("active");
$('#datosEmpresa').removeClass("active");
$('#seriesCorrelativos').removeClass("active");
$('#cuentasUsuarios').removeClass("active");
$('#accesosUsuarios').removeClass("active");
$('#certificadoDigital').removeClass("active");
$('#logUsuarios').addClass("active");
$('#sucursales').removeClass("active");
$('#almacenes').removeClass("active");
$('#ulConfiguraciones').addClass("in");
$("#ulConfiguraciones").attr("aria-expanded","true");