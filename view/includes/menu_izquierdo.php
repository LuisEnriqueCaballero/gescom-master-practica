<?php 


$sql = "select * from menu_grupousuario 
inner join menu on menu.menu_id=menu_grupousuario.menu_id
where menu_grupousuario.grupo_id=1";
$query = mysqli_query($con,$sql);
$s='';
while ($row = mysqli_fetch_array($query)) {
$menu_nombre = $row['menu_nombre'];
$menu_img = $row['menu_img'];
$menu_tipo = $row['menu_tipo'];
$menu_ruta = $row['menu_ruta'];
//echo'<script>alert("'.$menu_ruta.'");</script>';
if($menu_tipo=='MAESTRO'){
$s=$s.'<li class="" id="'.$menu_nombre.'"><a onclick=cargar_contenido("contenido_principal","modulos/'.$menu_ruta.'"); style="cursor: pointer;"><img src="../assets/images/svg-icon/'.$menu_img.'" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$menu_nombre.'</span></a></li>';
}elseif($menu_tipo=='CON HIJOS'){
$sql2 = "select * from menu_grupousuario 
inner join menu on menu.menu_id=menu_grupousuario.menu_id
where menu_grupousuario.grupo_id=1 and menu.menu_tipo='HIJO' and menu_padre='".$menu_nombre."' ";
$query2 = mysqli_query($con,$sql2);

$s=$s.'<li class="nav-dropdown">
<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/'.$menu_img.'" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$menu_nombre.'</span></a>
<ul class="collapse nav-sub bg-white bg-white" aria-expanded="false">';

while ($row2 = mysqli_fetch_array($query2)) {
	$menu_nombre2 = $row2['menu_nombre'];
	$menu_ruta2 = $row2['menu_ruta'];
	if($menu_ruta2=='#'){
$s=$s.'<li class="" id="'.$menu_nombre2.'"><a  style="cursor: pointer;font-weight: bold;"><span>'.$menu_nombre2.'</span></a></li>';

	}else{
$s=$s.'<li class="" id="'.$menu_nombre2.'"><a onclick=cargar_contenido("contenido_principal","modulos/'.$menu_ruta2.'"); style="cursor: pointer;"><span>'.$menu_nombre2.'</span></a></li>';
}	

}
$s=$s.'</ul></li>';
}

}	
?>

<nav class="main-menu">
					<ul class="nav metismenu">
						<li class="sidebar-header"><span>Men&uacute; De Navegaci&oacute;n</span></li>
						<?php echo $s;?>
						<!--<li class="" id="inicio"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/house.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Inicio</span></a></li>
						<li class="" id="eventos"><a onclick="cargar_contenido('contenido_principal','modulos/ss_eventos.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/calendar.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Calendario</span></a></li>
						<li class="" id="archivos"><a onclick="cargar_contenido('contenido_principal','modulos/ss_archivos.php')" style="cursor: pointer;"><img src="../assets/images/svg-icon/folder1.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Archivos</span></a></li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/cashier.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Caja</span></a>
							<ul class="collapse nav-sub bg-white bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/ca_caja.php')" style="cursor: pointer;"><span>Administrar Caja</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/ca_movCajas.php')" style="cursor: pointer;"><span>Hist&oacute;rico Caja</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown" id="personas">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/teamwork.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Personas</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false" id="ulPersonas">
								<li class="" id="clientes"><a onclick="cargar_contenido('contenido_principal','modulos/pp_clientes.php')" style="cursor: pointer;"><span>Clientes</span></a></li>
								<li class="" id="proveedores"><a onclick="cargar_contenido('contenido_principal','modulos/pp_proveedores.php')" style="cursor: pointer;"><span>Proveedores</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/pp_colaboradores.php')" style="cursor: pointer;"><span>Colaboradores</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/social-media.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Marketing</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/mm_mail.php')" style="cursor: pointer;"><span>E-mail</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown" id="almacen">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/trolley.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Art&iacute;culos</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false" id="ulAlmacen">
								<li class="" id="marcas"><a onclick="cargar_contenido('contenido_principal','modulos/pr_marcas.php')" style="cursor: pointer;"><span>Marcas</span></a></li>
								<li class="" id="categorias"><a onclick="cargar_contenido('contenido_principal','modulos/pr_categorias.php')" style="cursor: pointer;"><span>Categor&iacute;as</span></a></li>
								<li class="" id="productos"><a onclick="cargar_contenido('contenido_principal','modulos/pr_items.php')" style="cursor: pointer;"><span>&Iacute;tems</span></a></li>
								<li class="" id="kardex"><a onclick="cargar_contenido('contenido_principal','modulos/pr_kardex.php')" style="cursor: pointer;"><span>Kardex</span></a></li>
								<li class="" id="segmentos"><a onclick="cargar_contenido('contenido_principal','modulos/pr_traslados.php')" style="cursor: pointer;"><span>Traslados</span></a></li>
								<li class="" id="ajustarInventario"><a onclick="cargar_contenido('contenido_principal','modulos/pr_ajustarInventario.php')" style="cursor: pointer;"><span>Ajustes</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/shopping-bag1.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Ventas</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/vv_nuevaVenta.php')" style="cursor: pointer;"><span>Nuevo Documento</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/vv_ventas.php')" style="cursor: pointer;"><span>Historial Documentos</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/quote.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Cotizaciones</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/co_nuevaCotizacion.php')" style="cursor: pointer;"><span>Nueva Cotizaci&oacute;n</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/co_cotizaciones.php')" style="cursor: pointer;"><span>Historial Cotizaciones</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/spending.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Egresos</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cm_nuevaCompra.php')" style="cursor: pointer;"><span>Nueva Compra</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/ee_compras.php')" style="cursor: pointer;"><span>Historial Compras</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/ee_gastos.php')" style="cursor: pointer;"><span>Historial Gastos</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown" id="facturacionElectronica">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/sunat.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Fact. Electr&oacute;nica</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false" id="ulFacturacionElectronica">
								<li class="nav-dropdown">
									<a class="has-arrow" style="cursor: pointer;">Nota D&eacute;bito</a>
									<ul class="collapse nav-sub bg-white">
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_nuevaNDFactura.php')" style="cursor: pointer;"><span>Nuevo Para Factura</span></a></li>
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_nuevaNDBoleta.php')" style="cursor: pointer;"><span>Nuevo Para Boleta</span></a></li>
									</ul>
								</li>
								<li class="nav-dropdown">
									<a class="has-arrow" style="cursor: pointer;">Nota Cr&eacute;dito</a>
									<ul class="collapse nav-sub bg-white">
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_nuevaNCFactura.php')" style="cursor: pointer;"><span>Nuevo Para Factura</span></a></li>
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_nuevaNCBoleta.php')" style="cursor: pointer;"><span>Nuevo Para Boleta</span></a></li>
									</ul>
								</li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_resumenBoletas.php')" style="cursor: pointer;"><span>Resumen Diario</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_comunicacionBaja.php')" style="cursor: pointer;"><span>Comunicaci&oacute;n Baja</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/fe_guiaRemision.php')" style="cursor: pointer;"><span>Gu&iacute;a Remisi&oacute;n</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown" id="contabilidad">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/accounting.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Contabilidad</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false" id="ulContabilidad">
								<li class="nav-dropdown">
									<a class="has-arrow" style="cursor: pointer;">Libros Electr&oacute;nicos</a>
									<ul class="collapse nav-sub bg-white">
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_registroCompras.php')" style="cursor: pointer;"><span>Registro Compras</span></a></li>
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_registroVentas.php')" style="cursor: pointer;"><span>Registro Ventas</span></a></li>
									</ul>
								</li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_bancos.php')" style="cursor: pointer;"><span>Listado Bancos</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_cuentasBancarias.php')" style="cursor: pointer;"><span>Cuentas Bancarias</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_medioPagos.php')" style="cursor: pointer;"><span>Medio Pago</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/cashback.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Cr&eacute;ditos</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_cuentasPagar.php')" style="cursor: pointer;"><span>Cuentas Por Pagar</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/cc_cuentasCobrar.php')" style="cursor: pointer;"><span>Cuentas Por Cobrar</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/meeting.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>RR.HH</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false">
								 <li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rh_varLaboral.php')" style="cursor: pointer;"><span>Variables Laborales</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rh_listaAsistencia.php')" style="cursor: pointer;"><span>Lista Asistencia</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rh_cargos.php')" style="cursor: pointer;"><span>Cargos</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown" id="configuraciones">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/settings1.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Ajustes</span></a>
							<ul class="collapse nav-sub bg-white" aria-expanded="false" id="ulConfiguraciones">
								<li class="" id="datosEmpresa"><a onclick="cargar_contenido('contenido_principal','modulos/cf_datosEmpresa.php')" style="cursor: pointer;"><span>Datos Empresa</span></a></li>
								<li class="" id="sucursales"><a onclick="cargar_contenido('contenido_principal','modulos/cf_sucursales.php')" style="cursor: pointer;"><span>Establecimientos</span></a></li>
								<li class="" id="seriesCorrelativos"><a onclick="cargar_contenido('contenido_principal','modulos/cf_seriesCorrelativos.php')" style="cursor: pointer;"><span>Series Correlativos</span></a></li>
								<li class="" id="cuentasUsuarios"><a onclick="cargar_contenido('contenido_principal','modulos/cf_cuentasUsuarios.php')" style="cursor: pointer;"><span>Cuentas Usuarios</span></a></li>
								<li class="" id="accesosUsuarios"><a onclick="cargar_contenido('contenido_principal','modulos/cf_accesosUsuarios.php')" style="cursor: pointer;"><span>Grupos Usuarios</span></a></li>
								<li class="" id="certificadoDigital"><a onclick="cargar_contenido('contenido_principal','modulos/cf_certificadoDigital.php')" style="cursor: pointer;"><span>Certificado Digital</span></a></li>
								<li class="" id="logUsuarios"><a onclick="cargar_contenido('contenido_principal','modulos/cf_logUsuarios.php')" style="cursor: pointer;"><span>Log Usuarios</span></a></li>
								<li class="" id="almacenes"><a onclick="cargar_contenido('contenido_principal','modulos/cf_almacenes.php')" style="cursor: pointer;"><span>Almacenes</span></a></li>
							</ul>
						</li>
						<li class="nav-dropdown">
							<a class="has-arrow" style="cursor: pointer;" aria-expanded="false"><img src="../assets/images/svg-icon/statistics.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Reportes</span></a>
							<ul class="collapse nav-sub bg-white">
								<li class="nav-dropdown">
									<a class="has-arrow" style="cursor: pointer;">Ventas</a>
									<ul class="collapse nav-sub bg-white">
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rp_ventasUsuario.php')" style="cursor: pointer;"><span>Ventas Usuarios</span></a></li>
										<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rv_ventasCliente.php')" style="cursor: pointer;"><span>Ventas Clientes</span></a></li>
									</ul>
								</li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rp_consolidado.php')" style="cursor: pointer;"><span>Consolidado</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rp_balanceProductos.php')" style="cursor: pointer;"><span>Balance &Iacute;tems</span></a></li>
								<li class=""><a onclick="cargar_contenido('contenido_principal','modulos/rp_utilidadesProductos.php')" style="cursor: pointer;"><span>Utilidades &Iacute;tems</span></a></li>
							</ul>
						</li>-->
						<li class="sidebar-header"><span>Extras</span></li>
						<li class=""><a href="#"><img src="../assets/images/svg-icon/mp4.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Video Tutoriales</span></a></li>
						<li class=""><a href="#"><img src="../assets/images/svg-icon/pdf1.svg" style="width: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<span>Manual Usuario</span></a></li>
					</ul>
				</nav>