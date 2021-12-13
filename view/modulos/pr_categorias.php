<!-- Start Breadcrumbbar -->
<?php include "../modal/editarCategoria.php"; ?>
<?php include "../modal/registroCategoria.php"; ?>
<?php include "../modal/eliminarCategoria.php"; ?>

            <div class="content">
                    <nav aria-label="breadcrumb" style="margin-top: -6px;">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;">Inicio</a></li>
                        <li class="breadcrumb-item"><a onclick="load(1)" style="cursor: pointer;">Art&iacute;culos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado Categor&iacute;as</li>
                      </ol>
                    </nav>
                    <div class="page-content container-fluid" style="margin-top: -20px;">
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-white">
                                    <div class="card-body">
                                        <div id="ldng_cat"></div>
                                        <div id="resultados_ajax"></div>
                                        <div class='outer_div_cat'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script src="../js/categorias.js"></script>