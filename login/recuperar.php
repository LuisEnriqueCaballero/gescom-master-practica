<form class="sign-in-form" id="lg1" action="" method="post" autocomplete="off">
	<div class="card">
		<div class="card-body">
			<a href="index.html" class="brand text-center d-block m-b-20">
				<img src="../img/company/logo.png" alt="QuantumPro Logo" />
			</a>
			<!--<h5 class="sign-in-heading text-center">¿Olvisate tu contrase&ntilde;a?</h5>-->
			<p class="text-center text-muted">Ingresa tu correo para enviarte una nueva</p>
			<div class="form-group">
				<label for="email" class="sr-only">Correo electr&oacute;nico</label>
				<input type="mail" id="email" name="email" class="form-control" placeholder="Correo electr&oacute;nico" onKeyUp="this.value=this.value.toUpperCase();" required="">
			</div>
			<button class="btn btn-primary btn-rounded btn-floating btn-block" type="submit" id="reset">Recuperar Contrase&ntilde;a</button>
			<p class="text-muted m-t-25 m-b-0 p-0" style="text-align: center;">¿Ya tienes tu contrase&ntilde;a?<a onclick="cargar_contenido('contenido_principal','login.php');" style="cursor: pointer; color: #3c8dbc;"> Ingresa al sistema</a></p>
		</div>
	</div>
</form>
<script src="../js/recuperar.js"></script>
<script>
 	$('#email').focus();
</script>