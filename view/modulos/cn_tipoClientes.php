<style>
#wrap {
  margin: 50px;
  display: inline-block;
  position: relative;
  height: 60px;
  float: right;
  padding: 0;
  position: relative;
}

input[type="text"] {
  height: 60px;
  font-size: 14px;
  display: inline-block;
  font-weight: 100;
  border: none;
  outline: none;
  color: #555;
  padding: 3px;
  padding-right: 60px;
  width: 0px;
  position: absolute;
  top: 0;
  right: 0;
  background: none;
  z-index: 3;
  transition: width .4s cubic-bezier(0.000, 0.795, 0.000, 1.000);
  cursor: pointer;
}

input[type="text"]:focus:hover {
  border-bottom: 1px solid #BBB;
}

input[type="text"]:focus {
  width: 305px;
  z-index: 1;
  border-bottom: 1px solid #BBB;
  cursor: text;
}
input[type="submit"] {
  height: 67px;
  width: 63px;
  display: inline-block;
  color:red;
  float: right;
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFU1NT9fX1lJSUXl5e1dXVfn5+c3Nz6urqv7+/tLS0iYmJqampn5+fysrK39/faWlp////Vi4ZywAAABF0Uk5T/////////////////////wAlrZliAAABLklEQVR42rSWWRbDIAhFHeOUtN3/ags1zaA4cHrKZ8JFRHwoXkwTvwGP1Qo0bYObAPwiLmbNAHBWFBZlD9j0JxflDViIObNHG/Do8PRHTJk0TezAhv7qloK0JJEBh+F8+U/hopIELOWfiZUCDOZD1RADOQKA75oq4cvVkcT+OdHnqqpQCITWAjnWVgGQUWz12lJuGwGoaWgBKzRVBcCypgUkOAoWgBX/L0CmxN40u6xwcIJ1cOzWYDffp3axsQOyvdkXiH9FKRFwPRHYZUaXMgPLeiW7QhbDRciyLXJaKheCuLbiVoqx1DVRyH26yb0hsuoOFEPsoz+BVE0MRlZNjGZcRQyHYkmMp2hBTIzdkzCTc/pLqOnBrk7/yZdAOq/q5NPBH1f7x7fGP4C3AAMAQrhzX9zhcGsAAAAASUVORK5CYII=) center center no-repeat;
  text-indent: -10000px;
  border: none;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  cursor: pointer;
  opacity: 0.4;
  cursor: pointer;
  transition: opacity .4s ease;
}

input[type="submit"]:hover {
  opacity: 0.8;
}

</style>
				<div class="content">
					<header class="page-header">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h1 class="separator">Tipo Clientes</h1>
								<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;"><i class="la la-home"></i></a></li>
										<li class="breadcrumb-item active" aria-current="page">Contabilidad</li>
										<li class="breadcrumb-item active" aria-current="page">Tipo de clientes</li>
									</ol>
								</nav>
							</div>
							<ul class="actions top-right">
								<li class="dropdown">
									<a style="cursor: pointer;" class="btn btn-fab" data-toggle="dropdown" aria-expanded="false">
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
										<div class="dropdown-header">
											Acciones
										</div>
										<a onclick="load(1);" style="cursor: pointer;" class="dropdown-item">
											<i class="icon dripicons-clockwise"></i> Actualizar
										</a>
										<a href="#" class="dropdown-item">
											<i class="icon dripicons-plus"></i> Nuevo Cliente
										</a>
										<a href="#" class="dropdown-item">
											<i class="icon dripicons-export"></i> Exportar Excel
										</a>
										<a href="#" class="dropdown-item">
											<i class="icon dripicons-export"></i> Exportar PDF
										</a>
										<a href="#" class="dropdown-item">
											<i class="icon dripicons-print"></i> Imprimir
										</a>
									</div>
								</li>
							</ul>
						</div>
					</header>
					<div class="page-content container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div id="wrap" style="margin-top: -5px; margin-bottom: 10px; margin-right: -1px;">
										  <input id="q" type="text" placeholder="Buscar por nombre o documento..." onkeyup='load(1);this.value=this.value.toUpperCase();' autocomplete="off"><input id="search_submit" value="Rechercher" type="submit">
										</div>
										<div id="ldng_cat"></div>
                						<div class='outer_div_cat'></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<script src="../js/tipoClientes.js"></script>