<?php
session_start();
/* Connect To Database*/
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos

$user_id = $_SESSION['usuario_id'];
$tienda  = $_SESSION['tienda'];
?>
<div class="content">
	<nav aria-label="breadcrumb" style="margin-top: -6px;">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
        <li class="breadcrumb-item"><a onclick="load(1)" style="cursor: pointer;">Art&iacute;culos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Listado Almacenes</li>
      </ol>
    </nav>
    <div class="page-content container-fluid" style="margin-top: -20px;">
		<div class="contact-list">
			<div class="container-fluid">
				<div class="row">
					<!-- .col -->
					<?php
		                $sql = "select * from almacenes where almacen_idSucursal='$tienda' and almacen_activo='1' order by almacen_id asc";
		                $query = mysqli_query($con,$sql);
		                while ($row = mysqli_fetch_array($query)) {
		                    $almacen_id = $row['almacen_id'];
		                    $nombre = substr($row['almacen_direccion'], 0, 28).'...';

		                    $user = mysqli_query($con, "select * from productos where producto_idSucursal='$almacen_id'");
		                    $num  = mysqli_num_rows($user);
		            ?>
					<div class="col-md-6 col-lg-4 col-xxl-3">
						<div class="card contact-item bg-white" onclick="cargar_contenido('contenido_principal','modulos/pr_items1.php?almacen=<?php echo $almacen_id; ?>')" style="cursor: pointer;">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 text-center">
										<img src="../assets/images/svg-icon/warehouse.svg" alt="user" class="max-w-100 m-t-20">
									</div>
									<div class="col-md-12 text-center">
										<h5 class="card-title"><?php echo $row['almacen_nombre']; ?></h5>
										<small class="text-muted d-block">
											<?php echo $num; ?> &iacute;tems
										</small>
										<small class="text-muted d-block">
											<i class="icon dripicons-location"></i>
											<?php echo $nombre; ?>
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<!-- /.col -->
				</div>
			</div>
		</div>
	<!-- SIDEBAR QUICK PANNEL WRAPPER -->
	</div>
</div>
<script src="../js/items.js"></script>

<script src="../js/ventanaCentrada.js"></script>