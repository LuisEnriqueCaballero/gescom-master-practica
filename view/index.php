<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
//requerimos el archivo de configuracion
require_once "../config/general.php"; //Contiene las variables generales

//Nos conectamos a la base de datos
require_once "../config/db.php";
require_once "../config/conexion.php";
//Validamos la sesion de la empresa
$empresa = 1;
//Datos de la empresa logueada
$sql_empresa = mysqli_query($con, "select * from datosempresa where datosEmpresa_id=$empresa");
$rw_tienda = mysqli_fetch_array($sql_empresa);
$datosEmpresa_nombre = $rw_tienda['datosEmpresa_nombre'];
$datosEmpresa_favicon = $rw_tienda['datosEmpresa_favicon'];
$datosEmpresa_ruc = $rw_tienda['datosEmpresa_ruc'];

if ($datosEmpresa_favicon == 'favicon.png') {
	$rutaFavicon = '<link rel="shortcut icon" href="../img/company/favicon.png">';
} else {
	$rutaFavicon = '<link rel="shortcut icon" href="../img/company/' . $datosEmpresa_favicon . '">';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Titulo -->
	<!--=================================================-->
	<?php if (!empty($_SESSION['user_login_status']) and $_SESSION['tienda'] != "" and !empty($_SESSION['usuario_clave'])) { ?>
		<!-- Si esta dentro del panel -->
		<title>.:: Panel | <?php echo $datosEmpresa_nombre; ?> ::.</title>
	<?php } ?>
	<?php if (!empty($_SESSION['user_login_status']) and empty($_SESSION['usuario_clave'])) { ?>
		<!-- Si esta en la pantalla de bloqueo -->
		<title>.:: LockScreen | <?php echo $datosEmpresa_nombre; ?> ::.</title>
	<?php } ?>
	<?php if (!empty($_SESSION['user_login_status']) and $_SESSION['tienda'] == "") { ?>
		<!-- Si en el listado de establecimientos -->
		<title>.:: Establecimientos | <?php echo $datosEmpresa_nombre; ?> ::.</title>
	<?php } else { ?>
		<!-- Si esta en el login del usuario -->
		<title>.:: Login Usuario | <?php echo $datosEmpresa_nombre; ?> ::.</title>
	<?php } ?>
	<!-- Favicon -->
	<!--=================================================-->
	<!-- Si hay una sesion de empresa -->
	<?php echo $rutaFavicon; ?>
	<!-- ================== GOOGLE FONTS ==================-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
	<!-- ======================= GLOBAL VENDOR STYLES ========================-->
	<link rel="stylesheet" href="../assets/css/vendor/bootstrap.css">
	<link rel="stylesheet" href="../assets/vendor/metismenu/dist/metisMenu.css">
	<link rel="stylesheet" href="../assets/vendor/switchery-npm/index.css">
	<link rel="stylesheet" href="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
	<!-- ======================= LINE AWESOME ICONS ===========================-->
	<link rel="stylesheet" href="../assets/css/icons/line-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/icons/simple-line-icons.css">
	<link href="../assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
	<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- ======================= DRIP ICONS ===================================-->
	<link rel="stylesheet" href="../assets/css/icons/dripicons.min.css">
	<!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
	<link rel="stylesheet" href="../assets/css/icons/material-design-iconic-font.min.css">
	<!-- ======================= PAGE LEVEL VENDOR STYLES ============================-->
	<link rel="stylesheet" href="../assets/vendor/fullcalendar/dist/fullcalendar.css">
	<!--<link rel="stylesheet" href="../assets/vendor/morrisjs/morris.css">-->
	<link href="../assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">

	<!--<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">-->
	<link rel="stylesheet" href="../assets/vendor/bootstrap-daterangepicker/daterangepicker.css">
	<!-- ======================= PAGE VENDOR STYLES ===========================-->
	<link rel="stylesheet" href="../assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
	<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Table Bootstrap -->
	<link href="../assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
	<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet">
	<!-- ======================= GLOBAL COMMON STYLES ============================-->
	<link rel="stylesheet" href="../assets/css/common/main.bundle.css">
	<!-- ======================= LAYOUT TYPE ===========================-->
	<link rel="stylesheet" href="../assets/css/layouts/vertical/core/main.css">
	<!-- ======================= MENU TYPE ===========================-->
	<link rel="stylesheet" href="../assets/css/layouts/vertical/menu-type/default.css">
	<!-- ======================= THEME COLOR STYLES ===========================-->
	<link rel="stylesheet" href="../assets/css/layouts/vertical/themes/style.css">
	<!-- Loader CSS -->
	<link rel="stylesheet" href="../assets/css/loader/loader.css">
	<link rel="stylesheet" href="../assets/css/loader/loader2.css">
	<!-- Toastr CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/toastr/toastr.css">
	<link href="../assets/plugins/rich/src/richtext.min.css" rel="stylesheet">

	<!--<link type="text/css" href="../assets/datepicker/datepicker3.css" type="text/css" rel="stylesheet">
	<link href="../assets/datepicker/daterangepicker.css" rel="stylesheet">-->
	<link type="text/css" href="../js/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/plugins/wy/bootstrap3-wysihtml5.min.css">
	<link href="../assets/css/scrollbar.css" rel="stylesheet" type="text/css">

	<link href="../assets/plugins/morris-js/morris.min.css" rel="stylesheet">

	<link rel="stylesheet" href="../assets/css/dark-mode.css">
	<style>
		.ajax-loader {
			position: fixed;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: #fff;
			z-index: 9;
		}

		.ajax-loader img {
			position: absolute;
			top: 45%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.ajax-loader p {
			position: absolute;
			top: 51.5%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.bg-light {
			background-color: #2f2e44 !important;
		}

		.bg-body {
			background-color: #f0f6ff !important;
		}

		[data-theme="dark"] .ajax-loader {
			background-color: #2f2e44 !important;
		}
	</style>
</head>

<body style="cursor: url(../img/company/cursor.png), pointer; display: flex; justify-content: center; align-items: center;" class="bg-white layout-fixed" id="cuerpo">
	<div id="container-loader">
		<img src="../img/company/logo.png" width="200">
		<img src="../img/company/reloj.svg" width="50" style="top: 50.5%">
	</div>
	<!-- START APP WRAPPER -->
	<?php
	//Verificamos que la sesion de la empresa, la sesion del usuario, la sesion del establecimiento y la clave del usuario no esten vacios
	if (!empty($_SESSION['user_login_status']) and $_SESSION['tienda'] != "" and !empty($_SESSION['usuario_clave'])) {
		$empresa = 1;
		$tienda  = $_SESSION['tienda'];
		//Datos de la empresa logueada
		$sql_empresa = mysqli_query($con, "select * from datosempresa where datosEmpresa_id=$empresa");
		$rw_tienda = mysqli_fetch_array($sql_empresa);
		$datosEmpresa_logo = $rw_tienda['datosEmpresa_logo'];
		$datosEmpresa_nombre = $rw_tienda['datosEmpresa_nombre'];
		$datosEmpresa_favicon = $rw_tienda['datosEmpresa_favicon'];
		//Datos del establecimiento logueado
		$sql_sucursal = mysqli_query($con, "select * from sucursales where sucursal_tienda=$tienda");
		$rw_sucursal = mysqli_fetch_array($sql_sucursal);
		$sucursal_nombre = $rw_sucursal['sucursal_nombre'];
	?>
		<?php include "modal/lock.php"; ?>
		<?php include "modal/logout.php"; ?>
		<?php include "modal/cambiarEstablecimiento.php"; ?>
		<?php include "modal/cambiarClave.php"; ?>
		<div id="app">
			<!-- START MENU SIDEBAR WRAPPER -->
			<aside class="sidebar sidebar-left bg-white">
				<div class="sidebar-content bg-white">
					<div class="aside-toolbar bg-white">
						<ul class="site-logo">
							<li>
								<!-- START LOGO -->
								<a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">
									<div class="logo">
										<img src="../img/company/favicon.png" id="logo" width="25" height="25" viewBox="0 0 54.03 56.55">
									</div>
									<span class="brand-text" style="color: #2f2e44; font-size: 17px;"><?php echo substr($datosEmpresa_nombre, 0, 12) . '...'; ?>
								</a>
								<!-- END LOGO -->
							</li>
						</ul>
						<ul class="header-controls">
							<li class="nav-item">
								<button type="button" class="btn btn-link btn-menu" data-toggle-state="mini-sidebar">
									&nbsp;&nbsp;<img src="../assets/images/svg-icon/menu.png" style="width: 20px;">
								</button>
							</li>
						</ul>
					</div>
					<?php include "includes/menu_izquierdo.php"; ?>
				</div>
			</aside>
			<!-- END MENU SIDEBAR WRAPPER -->
			<div class="content-wrapper">
				<!-- START LOGO WRAPPER -->
				<nav class="top-toolbar navbar navbar-mobile navbar-tablet bg-white">
					<ul class="navbar-nav nav-left">
						<li class="nav-item">
							<a style="cursor: pointer;" data-toggle-state="aside-left-open">
								<i class="icon dripicons-align-left"></i>
							</a>
						</li>
					</ul>
					<ul class="navbar-nav nav-center site-logo">
						<li>
							<a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">
								<div class="logo_mobile">
									<img src="../img/company/favicon.png" id="logo_mobile" width="27" height="27" viewBox="0 0 54.03 56.55">
								</div>
								<span class="brand-text" style="color: #2f2e44;"><?php echo substr($datosEmpresa_nombre, 0, 12) . '...'; ?></span>
							</a>
						</li>
					</ul>
					<ul class="navbar-nav nav-right">
						<li class="nav-item">
							<a style="cursor: pointer;" data-toggle-state="mobile-topbar-toggle">
								<i class="icon dripicons-dots-3 rotate-90"></i>
							</a>
						</li>
					</ul>
				</nav>
				<!-- END LOGO WRAPPER -->
				<!-- START TOP TOOLBAR WRAPPER -->
				<?php include "includes/cabecera.php"; ?>
				<!-- END TOP TOOLBAR WRAPPER -->
				<!-- Cargamos contenido -->
				<div id="load_contenido"></div>
				<div id="contenido_principal"></div>
				<!--<section></section>-->
				<!-- Fin cargamos contenido -->
				<!-- SIDEBAR QUICK PANNEL WRAPPER -->
				<aside class="sidebar sidebar-right bg-white">
					<div class="sidebar-content">
						<div class="tab-panel m-b-30" id="sidebar-tabs">
							<ul class="nav nav-tabs primary-tabs">
								<li class="nav-item" role="presentation"><a style="cursor: pointer;" class="nav-link active show bg-white" data-toggle="tab" aria-expanded="true">Clientes</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fadeIn active" id="sidebar-contact">
									<!--START SEARCH WRAPPER -->
									<div class="search-wrapper m-b-30">
										<button type="submit" class="search-button-submit"><i class="icon dripicons-search site-search-icon"></i></button>
										<input autocomplete="off" type="text" id="q" class="form-control search-input no-focus-border" placeholder="Buscar por nombre, documento o contacto..." onkeyup='load_lateral(1);this.value=this.value.toUpperCase();'>
										<a style="cursor: pointer;" class="close-search-button" data-q-action="close-site-search">
											<i class="icon dripicons-cross site-search-close-icon"></i>
										</a>
									</div>
									<div id="ldng_lateral"></div>
									<div class='outer_div_lateral'></div>
								</div>
							</div>
						</div>
					</div>
				</aside>
				<!-- END SIDEBAR QUICK PANNEL WRAPPER -->
			</div>
			<form id="login_form" action="" method="post" autocomplete="off">
				<div class="modal fade" id="loginModal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalCenterTitle">Sesi&oacute;n Expirada</h5>
							</div>
							<div class="modal-body">
								<span id="error_message"></span>
								<div class="form-group">
									<label for="username" class="sr-only">Usuario o Correo electr&oacute;nico</label>
									<input type="text" id="username" name="username" class="form-control" placeholder="Usuario o Correo electr&oacute;nico" onKeyUp="this.value=this.value.toUpperCase();" required="">
								</div>
								<div class="form-group">
									<label for="password" class="sr-only">Contrase&ntilde;a</label>
									<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" onKeyUp="this.value=this.value.toUpperCase();" required="">
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary btn-block" id="login">Iniciar Sesi&oacute;n</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	<?php } ?>
	<?php
	//Si el usuario esta logueado y su clave vacia lo redirecciona a la pantalla de bloqueo
	if (!empty($_SESSION['user_login_status']) and empty($_SESSION['usuario_clave'])) {
		$empresa1 = 1;
		//Datos de la empresa
		$sql_empresa_lg = mysqli_query($con, "select * from datosempresa where datosEmpresa_id=$empresa1");
		$rw_tienda_lg = mysqli_fetch_array($sql_empresa_lg);
		$datosEmpresa_nombre = $rw_tienda_lg['datosEmpresa_nombre'];
	?>
		<div class="container" style="margin-top: -50px;">
			<form class="sign-in-form" id="lg1" action="" method="post" autocomplete="off">
				<div class="card">
					<div class="card-body">
						<a class="brand text-center d-block m-b-20">
							<img style="height: 150px" src="../img/user/<?php echo $_SESSION['usuario_foto']; ?>" alt="Prizma Technology Logo" />
						</a>
						<h5 class="sign-in-heading text-center m-b-20"><?php echo $_SESSION['usuario_alias']; ?></h5>
						<div class="form-group" style="display: none;">
							<label for="username" class="sr-only">Usuario o Correo electr&oacute;nico</label>
							<input type="text" id="username" name="username" class="form-control" placeholder="Usuario o Correo electr&oacute;nico" onKeyUp="this.value=this.value.toUpperCase();" required="" value="<?php echo $_SESSION['usuario_alias']; ?>">
						</div>

						<div class="form-group">
							<label for="password" class="sr-only">Contrase&ntilde;a</label>
							<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" onKeyUp="this.value=this.value.toUpperCase();" required="">
						</div>
						<button class="btn btn-primary btn-rounded btn-floating btn-block" type="submit" id="login">Desbloquear Sesi&oacute;n</button>
						<p id="is" class="text-muted m-t-25 m-b-0 p-0" style="text-align: center;">¿No eres t&uacute;? <a onclick="cargar_contenido('contenido_principal','salir.php')" style="cursor: pointer; color: #3c8dbc;">Haz click aqu&iacute; para salir</a></p>
					</div>
				</div>
			</form>
		</div>
	<?php } ?>
	<?php
	//Si el usuario esta logueado y no hay sesion del establecimiento lo redirecciona al listado de establecimientos
	if (!empty($_SESSION['user_login_status']) and $_SESSION['tienda'] == "") {
		$tienda = $_SESSION['tienda'];
		$empresa1 = 1;
		//Datos de la empresa
		$sql_empresa = mysqli_query($con, "select * from datosempresa where datosEmpresa_id=$empresa1");
		$rw_tienda = mysqli_fetch_array($sql_empresa);
		$datosEmpresa_id = $rw_tienda['datosEmpresa_id'];
		//Datos del establecimiento
		$sql = "select * from sucursales where sucursal_idEmpresa=$datosEmpresa_id and sucursal_activo=1 order by sucursal_nombre desc";
		$query = mysqli_query($con, $sql);
		//Ruta a redirigir
		$url = $ruta . "/view/";
		$a   = $url;
	?>
		<div class="container" style="margin-top: -50px;">
			<form class="sign-in-form" id="lg1" action="" method="post" autocomplete="off">
				<div class="card">
					<div class="card-body">
						<?php
						//Recorremos el listado de los establecimientos
						while ($row = mysqli_fetch_array($query)) {
							$sucursal_id            = $row['sucursal_id'];
							$sucursal_nombre        = $row['sucursal_nombre'];
							$sucursal_direccion     = $row['sucursal_direccion'];
							$sucursal_tienda        = $row['sucursal_tienda'];
							//Redirigimos al panel con la sesion del establecimiento
							for ($i = 1; $i <= $sucursal_tienda; $i++) {
								$tienda_actual = "window.open('ss_tienda.php?t=" . $i . "&a=" . $a . "','_self')";
							}
							//Si tenemos sesion activa se deshabilita el establecimiento actual
							if ($sucursal_tienda == $tienda) { ?>
								<li class="list-group-item" style="background: #FFF9CC;">
									<a>
										<div class="media">
											<img class="align-self-center mr-3" src="../assets/images/svg-icon/shops.svg" alt=" " style="width: 48px; height: 48px;">
											<div class="media-body p-t-10">
												<p class="mb-0 d-inline"><?php echo $sucursal_nombre; ?></p>
												<img src="../assets/images/svg-icon/checkmark.svg" class="img-fluid float-right" style="width: 20px; height: 20px;">
											</div>
										</div>
									</a>
								</li>
							<?php
								//Caso contrario nos lista todos los establecimientos
							} else { ?>
								<li class="list-group-item">
									<a onclick="<?php echo $tienda_actual; ?>" style="cursor: url(../img/company/cursorH1.png), pointer;">
										<div class="media">
											<img class="align-self-center mr-3" src="../assets/images/svg-icon/shops.svg" alt=" " style="width: 48px; height: 48px;">
											<div class="media-body p-t-10">
												<p class="mb-0 d-inline"><?php echo $sucursal_nombre; ?></p>
												<img src="../assets/images/svg-icon/right-arrow.svg" class="img-fluid float-right" style="width: 20px; height: 20px;">
											</div>
										</div>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</form>
		</div>
	<?php }
	if (empty($_SESSION['user_login_status'])) { ?>

		<div class="container">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-pills nav-pills-primary mb-3" id="pills-demo-1" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">Entrada</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Salida</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">Acceder</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent-1">
							<div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1">
								<form id="guarda_asistencia" action="" method="post" autocomplete="off">
									<a class="brand text-center d-block m-b-20">
										<img src="../img/company/logo.png" alt="Prizma Technology Logo" />
									</a>
									<div class="form-group">
										<label for="documento_colaborador" class="sr-only">Documento</label>
										<input type="number" class="form-control" placeholder="Documento de identidad" autofocus id="documento_colaborador" name="documento_colaborador" onKeyUp="this.value=this.value.toUpperCase();" required>
									</div>
									<button class="btn btn-success btn-rounded btn-floating btn-block" type="submit" id="guardar_datos">Marcar Entrada</button>
								</form>
							</div>
							<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2">
								<form id="guarda_salidaColaborador" action="" method="post" autocomplete="off">
									<a class="brand text-center d-block m-b-20">
										<img src="../img/company/logo.png" alt="Prizma Technology Logo" />
									</a>
									<div class="form-group">
										<label for="documento_colaborador1" class="sr-only">Documento</label>
										<input type="number" class="form-control" placeholder="Documento de identidad" autofocus id="documento_colaborador1" name="documento_colaborador1" onKeyUp="this.value=this.value.toUpperCase();" required>
									</div>
									<button class="btn btn-danger btn-rounded btn-floating btn-block" type="submit" id="guardar_datos1">Marcar Salida</button>
								</form>
							</div>
							<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3">
								<form id="lg1" action="" method="post" autocomplete="off">
									<a class="brand text-center d-block m-b-20">
										<img src="../img/company/logo.png" alt="Prizma Technology Logo" />
									</a>
									<div class="form-group">
										<label for="username" class="sr-only">Usuario</label>
										<input type="text" id="username" name="username" class="form-control" placeholder="Usuario" onKeyUp="this.value=this.value.toUpperCase();" required="">
									</div>

									<div class="form-group">
										<label for="password" class="sr-only">Contrase&ntilde;a</label>
										<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" onKeyUp="this.value=this.value.toUpperCase();" required="">
									</div>
									<button class="btn btn-primary btn-rounded btn-floating btn-block" type="submit" id="login">Iniciar Sesi&oacute;n</button>
									<p class="text-muted m-t-25 m-b-0 p-0" style="text-align: center;">¿Olvidaste tu contrase&ntilde;a? No te preocupes,<a onclick="cargar_contenido('contenido_principal','recuperar.php')" style="cursor: pointer; color: #3c8dbc;"> ingresa aqu&iacute; para recuperarla</a></p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- END CONTENT WRAPPER -->
	<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
	<script src="../assets/vendor/modernizr/modernizr.custom.js"></script>
	<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="../assets/plugins/vanilla/vanilla-toast.js"></script>
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/vendor/js-storage/js.storage.js"></script>
	<script src="../assets/vendor/js-cookie/src/js.cookie.js"></script>
	<script src="../assets/vendor/pace/pace.js"></script>
	<script src="../assets/vendor/metismenu/dist/metisMenu.js"></script>
	<script src="../assets/vendor/switchery-npm/index.js"></script>
	<script src="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	<!-- ================== PAGE LEVEL VENDOR SCRIPTS ==================-->
	<script src="../assets/vendor/countup.js/dist/countUp.min.js"></script>
	<script src="../assets/vendor/chart.js/dist/Chart.bundle.min.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.js"></script>
	<script src="../assets/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.resize.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.time.js"></script>
	<script src="../assets/vendor/flot.curvedlines/curvedLines.js"></script>
	<script src="../assets/vendor/datatables.net/js/jquery.dataTables.js"></script>
	<script src="../assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<!-- Table Bootstrap -->
	<script src="../assets/plugins/bootstrap-table/bootstrap-table.min.js"></script>
	<script src="../assets/plugins/bootstrap-table/locale/bootstrap-table-es-ES.js"></script>
	<script src="../assets/vendor/moment/min/moment.min.js"></script>
	<script src="../assets/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!--<script src="../assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>-->
	<script src="../assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="../assets/plugins/select2/js/select2.min.js"></script>
	<script src="../assets/plugins/wy/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="../assets/vendor/dropzone/dropzone.js"></script>
	<script src="../assets/vendor/ckeditor/ckeditor.js"></script>
	<!-- ================== GLOBAL APP SCRIPTS ==================-->
	<script src="../assets/js/global/app.js"></script>
	<!-- ================== PAGE LEVEL COMPONENT SCRIPTS ==================-->
	<!-- <script src="../assets/js/components/vertical-wizard-init.js"></script> -->
	<script src="../assets/js/components/custom-scrollbar.js"></script>
	<script src="../assets/js/components/fullcalendar-init.js"></script>
	<script src="../assets/js/components/bootstrap-datepicker-init.js"></script>
	<script src="../assets/js/components/range_1.js"></script>
	<script src="../assets/js/components/dropzone-init.js"></script>
	<!-- ================== PAGE LEVEL SCRIPTS ==================-->
	<script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
	<script src="../assets/toastr/toastr.js"></script>
	<script src="../assets/js/components/sweetalert2.js"></script>

	<script src="../js/asistencia.js"></script>
	<!-- Salida -->
	<script src="../js/asistencia2.js"></script>
	<script src="../js/cambiaEstablecimiento.js"></script>

	<script src="../js/jquery-ui.js"></script>
	<!-- Recuperamos el hash de la url y cargamos el contenido -->
	<script src="../js/index.js"></script>
	<!-- Administrador de archivos -->
	<script src="../assets/plugins/ckfinder/js/sf.js"></script>
	<script src="../assets/plugins/ckfinder/js/tree-a.js"></script>
	<script src="../assets/plugins/ckfinder/ckfinder.js"></script>
	<!-- Editor de texto -->
	<script src="../assets/plugins/ckeditor/ckeditor1.js"></script>
	<script src="../assets/plugins/ckeditor/clasic.js"></script>

	<script src="../assets/plugins/datepicker/datepicker.min.js"></script>
	<script src="../assets/plugins/datepicker/i18n/datepicker.en.js"></script>
	<script src="../assets/js/custom/custom-form-datepicker.js"></script>
	<script src="../assets/plugins/rich/src/jquery.richtext.js"></script>

	<script src="../js/lateral_derecho.js"></script>
	<script src="../js/login1.js"></script>
	<!-- <script src="../js/lockscreen.js"></script> -->
	<script src="../js/inicio.js"></script>
	<script src="../js/lock.js"></script>
	<script src="../js/logout.js"></script>

	<!--<script src="../assets/vendor/morrisjs/morris.js"></script>-->
	<script src="../assets/plugins/morris-js/morris.min.js"></script>
	<script src="../assets/plugins/morris-js/raphael-js/raphael.min.js"></script>

	<script src="../js/dark-mode-switch.js"></script>
	<script>
		$(document).ready(function() {
			var is_session_expired = 'no';

			function check_session() {
				$.ajax({
					url: "funciones/check_session.php",
					method: "POST",
					success: function(data) {
						if (data == '1') {
							$('#loginModal').modal({
								backdrop: 'static',
								keyboard: false,
							});
							is_session_expired = 'yes';
						}
					}
				})
			}

			var count_interval = setInterval(function() {
				check_session();
				if (is_session_expired == 'yes') {
					clearInterval(count_interval);
				}
			}, 3000);

			$('#login_form').on('submit', function(event) {
				event.preventDefault();
				$.ajax({
					url: "funciones/check_login.php",
					method: "POST",
					data: $(this).serialize(),
					beforeSend: function() {
						$('#login').attr("disabled", true);
						$("#login").html('<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Verificando...');
					},
					success: function(data) {
						if (data != '') {
							$('#username').attr("disabled", true);
							$('#password').attr("disabled", true);
							$("#login").html('<img src="../img/company/load1.svg" style="width: 16px;"> &nbsp;Conectando...');
							swal({
								type: 'success',
								title: 'Bienvenido',
								text: 'Te estamos redirigiendo al panel...',
								timer: 2000,
								onOpen: () => {
									swal.showLoading()
								}
							})
							setTimeout(' window.location.href = "../view/"; ', 2000);
						} else {
							$('#error_message').html(data);
							$('#username').focus();
							$('#login').attr("disabled", false);
							$("#login").html('Iniciar Sesi&oacute;n');
							swal({
								type: 'error',
								title: 'Oops...',
								text: 'Los datos ingresados son incorrectos',
								timer: 1500,
								onOpen: () => {
									swal.showLoading()
								}
							})
						}
					}
				})
			});
		})
	</script>
	<!-- Cargamos el contenido -->
	<script>
		function cargar_contenido(contenedor, contenido) {
			$("#" + contenedor).load(contenido, function(responseTxt, statusTxt, xhr) {
				if (statusTxt == "success") {
					$("#load_contenido").fadeIn('slow');
					$.ajax({
						url: contenido,
						beforeSend: function(objeto) {
							$('#load_contenido').html('<img src="../img/company/logo.png" width="150"><img src="../img/company/barras.svg" width="50" style="top: 50%">');
							$('#load_contenido').addClass('ajax-loader');
							$('html, body').animate({
								scrollTop: 0
							}, '600', 'swing')
						},
						success: function(data) {
							$("#" + contenedor).html(data).fadeIn('slow');
							$('#load_contenido').html('');
							$('#load_contenido').removeClass('ajax-loader');
						}
					})
				}
				if (statusTxt == "error") {
					toastr.info("No encontramos el modulo...", "Aviso");
				}
			});
		}
	</script>
	<!-- Fin cargamos el contenido -->
	<!-- Funcion del loader -->
	<script>
		window.onload = function() {
			var container = document.getElementById('container-loader');
			container.style.visibility = 'hidden';
			container.style.opacity = '0';
		}
	</script>
	<!-- Fin funcion del loader -->
</body>

</html>