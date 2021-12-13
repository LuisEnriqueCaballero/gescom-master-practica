<?php
$tienda = $_SESSION['tienda'];

$sucursales=mysqli_query($con,"select * from sucursales where sucursal_tienda=$tienda");
$rw_sucu=mysqli_fetch_array($sucursales);
$sucursal_nombre=$rw_sucu['sucursal_nombre'];

$actual = $_SESSION['usuario_id'];
//Datos del usuario
$sql_usuario            = mysqli_query($con,"select * from usuarios where usuario_id='$actual'");
$rw_usuario             = mysqli_fetch_array($sql_usuario);
$usuario_idColaborador  = $rw_usuario['usuario_idColaborador'];
$usuario_alias  		= $rw_usuario['usuario_alias'];
//Datos del colaborador
$sql_colaborador        = mysqli_query($con,"select * from colaboradores where colaborador_id='$usuario_idColaborador'");
$rw_colaborador         = mysqli_fetch_array($sql_colaborador);
$colaborador_foto       = $rw_colaborador['colaborador_foto'];
$colaborador_cargo      = $rw_colaborador['colaborador_cargo'];
//Datos del cargo
$sql_cargo              = mysqli_query($con,"select * from cargo where cargo_id='$colaborador_cargo'");
$rw_cargo               = mysqli_fetch_array($sql_cargo);
$cargo_nombre           = $rw_cargo['cargo_nombre'];
?>			
			<nav class="top-toolbar navbar navbar-desktop flex-nowrap bg-light">
				<ul class="navbar-nav nav-left">
					<li class="nav-item nav-text dropdown dropdown-menu-md">
						<a style="cursor: pointer; margin-top: -3px">
							<span>
								<b>Establecimiento: </b><?php echo $sucursal_nombre; ?>
							</span>
						</a>
					</li>
				</ul>
				<!-- START RIGHT TOOLBAR ICON MENUS -->
				<ul class="navbar-nav nav-right">
					<li class="nav-item nav-text dropdown dropdown-menu-md">
						<div class="form-group row" style="margin-top: 15px;">
				            <input type="checkbox" class="tgl tgl-light tgl-secondary input-sm" id="darkSwitch">
				            <label class="tgl-btn" for="darkSwitch"></label>
				         </div>
					</li>
					<li class="nav-item dropdown dropdown-menu-lg">
						<a style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<img src="../assets/images/svg-icon/apps_head.svg" style="width: 20px; margin-top: 8px;">
						</a>
						<div class="dropdown-menu dropdown-menu-right p-0 bg-white">
							<div class="dropdown-menu-grid">
								<div class="menu-grid-row">
									<div><a class="dropdown-item  border-bottom border-right" onclick="cargar_contenido('contenido_principal','modulos/mm_mail.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/social-media.svg" style="width: 40px;"><span>Mail Marketing</span></a></div>
									<div><a class="dropdown-item  border-bottom" onclick="cargar_contenido('contenido_principal','modulos/pos.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/escala.svg" style="width: 40px;"><span>TPV</span></a></div>
								</div>
								<div class="menu-grid-row">
									<div><a class="dropdown-item  border-right" onclick="cargar_contenido('contenido_principal','modulos/vv_ventas.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/shopping-bag1.svg" style="width: 40px;"><span>Ventas</span></a></div>
									<div> <a class="dropdown-item" onclick="cargar_contenido('contenido_principal','modulos/ss_eventos.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/calendar.svg" style="width: 40px;"><span>Calendario</span></a></div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-notifications dropdown-menu-lg">
						<a style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<img src="../assets/images/svg-icon/bell_head.svg" style="width: 20px; margin-top: 8px;">
						</a>
						<div class="dropdown-menu dropdown-menu-right bg-white">
							<div class="card card-notification bg-white">
								<div class="card-header">
									<h5 class="card-title">Notificaciones</h5>
									<ul class="actions top-right">
										<li>
											<a style="cursor: pointer;" data-q-action="open-notifi-config">
												<i class="icon dripicons-gear"></i>
											</a>
										</li>
									</ul>
								</div>
								<div class="card-body">
									<div class="card-container-wrapper">
										<div class="card-container">
											<div class="timeline timeline-border">
												<div class="timeline-list">
													<div class="timeline-info">
														<div><strong>30</strong> Productos Bajo De Stock</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_productosBajoStock.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
												<div class="timeline-list timeline-border timeline-primary">
													<div class="timeline-info">
														<div><strong>30</strong> Productos Vencidos</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_productosVencidos.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
												<div class="timeline-list  timeline-border timeline-accent">
													<div class="timeline-info">
														<div><strong>0</strong> Documentos Rechazados</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_documentosRechazados.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
												<div class="timeline-list  timeline-border timeline-success">
													<div class="timeline-info">
														<div><strong>30</strong> Documentos Aceptados</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_documentosAceptados.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
												<div class="timeline-list  timeline-border timeline-warning">
													<div class="timeline-info">
														<div><strong>0</strong> Documentos Pendientes</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_documentosPendientes.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
												<div class="timeline-list  timeline-border timeline-info">
													<div class="timeline-info">
														<div><strong>0</strong> Eventos Para Hoy</div>
														<a onclick="cargar_contenido('contenido_principal','modulos/ss_eventosHoy.php')" style="cursor: pointer;"><strong><small class="text-muted">Ver Detalles</small></strong></a>
													</div>
												</div>
											</div>
										</div>
										<div class="card-container">
											<h6 class="p-0 m-0">
												Configurar Notificaciones:
											</h6>
											<br>
											<div class="row m-b-20">
												<div class="col-10"><span class="title"><i class="la la-barcode"></i>Stock</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
											</div>
											<div class="row m-b-20">
												<div class="col-10"><span class="title"><i class="la la-clock-o"></i>Vencimiento</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
											</div>
											<div class="row m-b-20">
												<div class="col-10"><span class="title"><i class="la la-close"></i>Rechazados</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
											</div>
											<div class="row m-b-20">
												<div class="col-10"><span class="title"><i class="la la-check"></i>Aceptados</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
											</div>
											<div class="row m-b-20">
												<div class="col-10"><span class="title"><i class="la la-circle"></i>Pendientes</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
											</div>
											<div class="row m-b-20 m-t-30">
												<div class="col-10"><span class="title"><i class="la la-calendar"></i>Agenda | Eventos</span></div>
												<div class="col-2"><input type="checkbox" class="js-switch" checked /></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link nav-pill user-avatar" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
							<img src="../img/user/<?php echo $_SESSION['usuario_foto']; ?>" class="w-35 rounded-circle" alt="<?php echo $_SESSION['usuario_alias']; ?>" style="margin-top: -8px;">
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-accout bg-white">
							<div class="dropdown-header pb-3">
								<div class="media d-user">
									<img class="align-self-center mr-3 w-40 rounded-circle" src="../img/user/<?php echo $colaborador_foto; ?>" alt="<?php echo $_SESSION['usuario_alias']; ?>">
									<div class="media-body">
										<h5 class="mt-0 mb-0"><?php echo $usuario_alias; ?></h5>
										<span><?php echo $cargo_nombre; ?></span>
									</div>
								</div>
							</div>
							<a class="dropdown-item" onclick="cargar_contenido('contenido_principal','modulos/ss_perfilUsuario.php')" style="cursor: pointer;"><img src="../img/user/<?php echo $colaborador_foto; ?>" style="width: 20px;"> &nbsp;Perfil</a>
							<!--<a class="dropdown-item" onclick="cargar_contenido('contenido_principal','modulos/ss_bandejaEntrada.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/chat.svg" style="height: 20px;"> &nbsp;Mensajes <span class="badge badge-accent rounded-circle w-15 h-15 p-0 font-size-10">4</span></a>-->
							<a class="dropdown-item" data-toggle="modal" data-target="#change_password" style="cursor: pointer;"><img src="../assets/images/svg-icon/lock.svg" style="height: 20px;"> &nbsp;Cambiar Contrase&ntilde;a </a>
							<a class="dropdown-item" data-toggle="modal" data-target="#cambiaEstablecimiento" style="cursor: pointer;"><img src="../assets/images/svg-icon/shops.svg" style="height: 20px;"> &nbsp;Cambiar Establecimiento </a>
							<a class="dropdown-item" data-toggle="modal" data-target="#lockscreen" style="cursor: pointer;"><img src="../assets/images/svg-icon/lock1.svg" style="height: 20px;"> &nbsp;Bloquear Sesi&oacute;n</a>
							<a class="dropdown-item" data-toggle="modal" data-target="#salir" style="cursor: pointer;"><img src="../assets/images/svg-icon/arrow.svg" style="height: 20px;"> &nbsp;Cerrar Sesi&oacute;n</a>
						</div>
					</li>
					<li class="nav-item">
						<a style="cursor: pointer;" data-toggle-state="aside-right-open">
							<i class="icon dripicons-align-right" style="margin-top: -4px;"></i>
						</a>
					</li>
				</ul>
				<!-- END RIGHT TOOLBAR ICON MENUS -->
			</nav>