<!-- Start Breadcrumbbar -->
<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
/* Connect To Database*/
session_start();
require_once "../../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../../config/conexion.php"; //Contiene funcion que conecta a la base de datos
?>
            <div class="content">
                <header class="page-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h1 class="separator">Listado Sucursales</h1>
                            <nav class="breadcrumb-wrapper" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a onclick="cargar_contenido('contenido_principal','modulos/ss_inicio.php')" style="cursor: pointer;"><i class="la la-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Listado Sucursales</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
                <div class="page-content container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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
<script src="../js/seleccionarSucursal.js"></script>