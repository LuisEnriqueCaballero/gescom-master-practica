<form class="sign-in-form" id="lg1" action="" method="post" autocomplete="off">
	<div class="card">
		<div class="card-body">
			<a class="brand text-center d-block m-b-20">
				<img src="../img/company/logo.png" alt="Prizma Technology Logo" />
			</a>
			<div class="form-group">
				<label for="username" class="sr-only">Usuario o Correo electr&oacute;nico</label>
				<input type="text" id="username" name="username" class="form-control" placeholder="Usuario o Correo electr&oacute;nico" onKeyUp="this.value=this.value.toUpperCase();" required="">
			</div>

			<div class="form-group">
				<label for="password" class="sr-only">Contrase&ntilde;a</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" onKeyUp="this.value=this.value.toUpperCase();" required="">
			</div>
			<button class="btn btn-primary btn-rounded btn-floating btn-block" type="submit" id="login">Iniciar Sesi&oacute;n</button>
			<p class="text-muted m-t-25 m-b-0 p-0" style="text-align: center;">¿Olvidaste tu contrase&ntilde;a? No te preocupes,<a onclick="cargar_contenido('contenido_principal','recuperar.php')" style="cursor: pointer; color: #3c8dbc;"> ingresa aqu&iacute; para recuperarla</a></p>
		</div>
	</div>
</form>
<script src="../js/login1.js"></script>
<script>
 	$('#username').focus();
</script>