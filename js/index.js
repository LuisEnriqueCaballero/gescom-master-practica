/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
function loadContent(hash) {
  //Si se tiene conexion a internet cargara el contenido
  if (navigator.onLine) {
    if (hash === '') {
      $('#contenido_principal').load('modulos/ss_inicio.php');
    }
    $('html, body').animate({ scrollTop: 0 }, '600', 'swing');
    $('#contenido_principal').load('modulos/' + hash + '.php');
    //Caso contrario indicara la alerta
  } else {
    vt.error('Por favor verifica tu conexi&oacute;n a internet.', {
      duration: 2000,
      fadeDuration: 200,
      title: 'Oopss!',
      position: 'top-center',
    });
  }
}
$(window).on('hashchange', function () {
  loadContent(location.hash.slice(1));
});
var url = window.location.href;
var hash = url.substring(url.indexOf('#') + 1);
if (hash === url) {
  $('#contenido_principal').load('modulos/ss_inicio.php');
}
$('#contenido_principal').load('modulos/' + hash + '.php');
