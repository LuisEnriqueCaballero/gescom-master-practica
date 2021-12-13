<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
include("../config/db.php");
include("../config/conexion.php");
include("../view/funciones/funciones.php");
include('is_logged.php');
	if (empty($_POST['producto_codigo'])) {
           $errors[] = "Debes buscar un c&oacute;digo de SUNAT...";
        } else if (empty($_POST['producto_codigoBarras'])){
			$errors[] = "Debes poner un c&oacute;digo de barras o interno...";
		} else if (!empty($_POST['producto_codigo']) && !empty($_POST['producto_codigoBarras'])) {
		
		$producto_codigo=mysqli_real_escape_string($con,(strip_tags($_POST["producto_codigo"],ENT_QUOTES)));
		$producto_nombre=mysqli_real_escape_string($con,(strip_tags($_POST["producto_nombre"],ENT_QUOTES)));
		$producto_descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["producto_descripcion"],ENT_QUOTES)));
		$producto_codigo=mysqli_real_escape_string($con,(strip_tags($_POST["producto_codigo"],ENT_QUOTES)));
		$producto_idCategoria = intval($_POST["producto_idCategoria"]);
		$producto_idMarca = intval($_POST["producto_idMarca"]);
		$producto_idUnidadMedida = intval($_POST["producto_idUnidadMedida"]);
		$producto_idProveedor = intval($_POST["producto_idProveedor"]);
		$producto_afectacion = intval($_POST["producto_afectacion"]);
		$producto_monVenta = intval($_POST["producto_monVenta"]);
		$producto_costo=mysqli_real_escape_string($con,(strip_tags($_POST["producto_costo"],ENT_QUOTES)));
		$producto_precio=mysqli_real_escape_string($con,(strip_tags($_POST["producto_precio"],ENT_QUOTES)));
		$producto_stock=mysqli_real_escape_string($con,(strip_tags($_POST["producto_stock"],ENT_QUOTES)));
		$producto_minimo=mysqli_real_escape_string($con,(strip_tags($_POST["producto_minimo"],ENT_QUOTES)));
		$producto_codigoBarras=mysqli_real_escape_string($con,(strip_tags($_POST["producto_codigoBarras"],ENT_QUOTES)));
		$producto_fechaVencimiento = date($_POST["producto_fechaVencimiento"]);
		$producto_idSegmento = intval($_POST["producto_idSegmento"]);
		$producto_idFamilia = intval($_POST["producto_idFamilia"]);
		$producto_idClase = intval($_POST["producto_idClase"]);
		$producto_idProducto = intval($_POST["producto_idProducto"]);
		$producto_icbper = intval($_POST["producto_icbper"]);
		$almacen = $_POST["almacenP"];
		$tienda=$_SESSION['tienda'];
		$producto_fechaRegistro = date('Y-m-d');

		$users            = intval($_SESSION['usuario_id']);

		if ($producto_afectacion == 1 or $producto_afectacion == 2 or $producto_afectacion == 3 or $producto_afectacion == 4 or $producto_afectacion == 5 or $producto_afectacion == 6 or $producto_afectacion == 7 or $producto_afectacion == 8) {
			$producto_igv = 1;
		}
		if ($producto_afectacion == 9 or $producto_afectacion == 10) {
			$producto_igv = 2;
		}
		if ($producto_afectacion == 11 or $producto_afectacion == 12 or $producto_afectacion == 13 or $producto_afectacion == 14 or $producto_afectacion == 15 or $producto_afectacion == 16 or $producto_afectacion == 17 or $producto_afectacion == 18) {
			$producto_igv = 3;
		}
		
		$sql1 = "select * from productos where producto_codigoBarras='".$producto_codigoBarras."' and producto_idSucursal='".$almacen."'";
		$query_check_marca = mysqli_query($con,$sql1);
		$query_check_marca=mysqli_num_rows($query_check_marca);
		if ($query_check_marca == 1) { ?>
			<script>
				toastr["info"]("El c&oacute;digo de barras est&aacute; en uso...", "Precauci&oacute;n!");
			</script>
		<?php }else{
			$sql="insert into productos (
			producto_codigo, 
			producto_nombre, 
			producto_estado,
			producto_fechaRegistro,
			producto_precio,
			producto_costo,
			producto_monCosto,
			producto_monVenta,
			producto_idMarca,
			producto_descripcion,
			producto_codigoBarras,
			producto_stock,
			producto_minimo,
			producto_fechaVencimiento,
			producto_idSegmento,
			producto_idFamilia,
			producto_idClase,
			producto_idCategoria,
			producto_ser,
			producto_foto,
			producto_adjunto,
			producto_inventario,
			producto_idUnidadMedida,
			producto_idSucursal,
			producto_afectacion,
			producto_igv,
			producto_idProveedor,
			producto_idProducto,
			producto_icbper,
			producto_vendido
			) 
			values (
			'$producto_codigo',
			'$producto_nombre',
			'1',
			'$producto_fechaRegistro',
			'$producto_precio',
			'$producto_costo',
			'$producto_monVenta',
			'$producto_monVenta',
			'$producto_idMarca',
			'$producto_descripcion',
			'$producto_codigoBarras',
			'$producto_stock',
			'$producto_minimo',
			'$producto_fechaVencimiento',
			'$producto_idSegmento',
			'$producto_idFamilia',
			'$producto_idClase',
			'$producto_idCategoria',
			'1',
			'nuevo.jpg',
			'--',
			'1',
			'$producto_idUnidadMedida',
			'$almacen',
			'$producto_afectacion',
			'$producto_igv',
			'$producto_idProveedor',
			'$producto_idProducto',
			'$producto_icbper',
			'0'
			)";
			$query_new_insert = mysqli_query($con,$sql);

			//Seleccionamos el ultimo compo numero_fatura y aumentamos una
		    $sql         = mysqli_query($con, "select LAST_INSERT_ID(producto_id) as last from productos order by producto_id desc limit 0,1 ");
		    $rw          = mysqli_fetch_array($sql);
		    $producto_id = $rw['last'];
		    //GURDAMOS LAS ENTRADAS EN EL KARDEX
		    $saldo_total    = $producto_stock * $producto_costo;
		    $sql_kardex     = mysqli_query($con, "select * from kardex where kardex_idProducto='" . $producto_stock . "' order by kardex_id DESC LIMIT 1");
		    $rww            = mysqli_fetch_array($sql_kardex);
		    $kardex_cantidadSaldo     = $rww['kardex_cantidadSaldo'] + $producto_stock;
		    $saldo_full     = ($rww['kardex_totalSaldo'] + $saldo_total);
		    $costo_promedio = ($rww['kardex_totalSaldo'] + $saldo_total) / $kardex_cantidadSaldo;
		    $tipo           = 5;

			guardar_entradas($producto_fechaRegistro, $producto_id, $producto_stock, $producto_costo, $saldo_total, $kardex_cantidadSaldo, $costo_promedio, $saldo_full, $producto_fechaRegistro, $users, $tipo);

			if ($query_new_insert){ ?>
				<script>
					toastr["success"]("Datos registrados", "Bien hecho!");
				</script>
			<?php } else{ ?>
				<script>
					toastr["warning"]("<?php echo mysqli_error($con); ?>", "Aviso!");
				</script>
			<?php }
		}
		}else { ?>
			<script>
				toastr["error"]("Error desconocido", "Oopss!");
			</script>
	<?php }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger alert-outline alert-dismissible fade show" role="alert">
			<?php
			foreach ($errors as $error) {
					echo $error;
				}
			?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true" class="la la-close"></span>
			</button>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
			<div class="alert alert-success alert-outline alert-dismissible fade show" role="alert">
			<?php
			foreach ($messages as $message) {
					echo $message;
				}
			?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true" class="la la-close"></span>
			</button>
			</div>
				<?php
			}

?>