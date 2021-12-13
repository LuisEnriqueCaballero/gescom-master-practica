<!---------------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
----------------------------------->
<?php
//Verificamos si el usuario esta logueado, si no esta logueado lo redirecciona al login, si ya esta logueado se queda en el panel
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
   header("location: ../login/");
   exit;
}
//requerimos el archivo de configuracion
require_once "../../config/general.php"; //Contiene las variables generales
//Nos conectamos a la base de datos
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos

$sex = $_SESSION['usuario_sexo'];
if ($sex==1) {
   $sexo = "Masculino";
}
if ($sex==2) {
   $sexo = "Femenino";
}
?>
				<div class="content">
					<section class="page-content container-fluid">
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="profile-card text-center">
											<div class="thumb-xl member-thumb m-b-10 center-block">
												<img style="height: 200px;" src="../img/user/<?php echo $_SESSION['usuario_foto']; ?>" class="rounded-circle img-thumbnail" alt="profile-image">
											</div>
											<div class="">
												<h5 class="m-b-5"><?php echo $_SESSION['usuario_nombres']; ?></h5>
												<p class="text-muted"></p>
											</div>
											<button type="button" class="btn btn-primary btn-rounded" onclick="cargar_contenido('contenido_principal','modulos/ss_pos.php')" style="cursor: pointer;">Vender</button>
											<button type="button" class="btn btn-accent btn-rounded" onclick="cargar_contenido('contenido_principal','modulos/ss_cotizador.php')" style="cursor: pointer;">Cotizar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8">
								<div class="card card-tabs">
									<div class="card-header p-0 no-border">
										<ul class="nav nav-tabs primary-tabs p-l-30 m-0">
											<li class="nav-item" role="presentation"><a href="#profile-about" class="nav-link active show" data-toggle="tab" aria-expanded="true">Sobre M&iacute;</a></li>
										</ul>
									</div>
									<div class="card-body">
										<div class="tab-content">
											<div class="tab-pane fadeIn active" id="profile-about">
												<div class="profile-wrapper p-t-20">
													<h5 class="card-title">Descripci&oacute;n</h5>
													<p>----</p>
													</div>
													<div class="profile-wrapper">
														<h5 class="card-title">Informaci&oacute;n B&aacute;sica</h5>
														<ul class="list-reset p-t-10">
															<li class="p-b-10"><span class="w-150 d-inline-block">Cumplea&ntilde;os:</span><span>01/07/1994</span></li>
															<li class="p-b-10"><span class="w-150 d-inline-block">Alias:</span><span><?php echo $_SESSION['usuario_alias']; ?></span></li>
															<li class="p-b-10"><span class="w-150 d-inline-block">Tel&eacute;fono:</span><span><?php echo $_SESSION['usuario_telefono']; ?></span></li>
															<li class="p-b-10"><span class="w-150 d-inline-block">Correo:</span><span><?php echo $_SESSION['usuario_email']; ?></span></li>
															<li class="p-b-10"><span class="w-150 d-inline-block">Sexo:</span><span><?php echo $sexo; ?></span></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
<script src="../js/perfilUsuario.js"></script>