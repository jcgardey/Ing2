<DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Bestnid</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="Bootstrap/css/bootstrap-theme.min.css">
		
		<link rel="stylesheet" href="estilopropio.css">
		<link rel="stylesheet" href="Bootstrap/css/jquery-ui.css" />

		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarRegistro.js"></script>
		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
				
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				 	<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" rel="home" href="index.php" title="Logotipo">
        				<img style="max-height:100%;,max-width:100%;" src="logo.png" />
    				</a>
					</div>
					<ul class="nav navbar-nav navbar-left">	
							<li>
								<a class="navbar-brand" href="home.php">Bestnid</a>
							</li>			
					</ul>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Buscar producto">
							</div>
							<button type="submit" class="btn btn-default">Buscar</button>
						</form>
						<ul class="nav navbar-nav navbar-right">	
							<li>
								<a class="navbar-brand" href="registrarse.php">Registrarse</a>
							</li>
							<li>
								<a class="navbar-brand" href="registrarse.php">Ayuda</a>
							</li>	
						</ul>
						<!-- Inicio de sesión -->
						<form class="navbar-form navbar-right" id="formulario" action="validarSesion.php" method="POST">
							<div class="form-group">
								<div id="user">
									<label class="sr-only" for="exampleInputEmail3">Usuario</label>
									<input name="input_user" type="text" class="form-control" id="exampleInputEmail3" placeholder="Usuario">
								</div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword3">Contraseña</label>
								<input name="input_password" type="password" class="form-control" id="exampleInputPassword3" placeholder="Contraseña">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> Recordarme
								</label>
							</div>
							<button type="submit" id= "btn_entrar" class="btn btn-danger">Entrar</button>
							<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="si") ) { ?>
									<p class="text-warning">¡Datos incorrectos!</p>
							<?php } ?>
						</form>
						<!--Fin Inicio de Sesión -->
					</div>
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		<section class="main container">
			<div class="row">
				<div class="col-md-3">
					<h2>Sumate a Bestnid</h2>
				</div>
				<div class="col-md-9">
					<form name="frm-registro" id="f_registro" action="validarRegistro.php" method="POST">
						<div class="form-group">
							<label>Nombres y Apellidos<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input type="text" class="form-control" name="nombres" id="inputNombres" placeholder="Nombres">
								<input type="text" class="form-control" name="apellidos" id="inputApellidos" placeholder="Apellidos">
							</div>
							<div id="campoNombresyApellidos">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Usuario<span class="text-danger">*</span></label>
							<input type="text" name="nombreUsuario" class="form-control" id="inputUsuario" placeholder="entre 4 y 15 caracteres, letras y números">
							<div id="campoUsuario">
								<?php
								if ( (isset($_GET["errorUsuario"]) ) && ($_GET["errorUsuario"]=="si") ) { ?>
									<p class="text-danger">El nombre de usuario ya existe</p>
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="e_mail" id="inputEmail" placeholder="alguien@ejemplo.com">
							<div id="campoEmail">
							</div>
						</div>
						<div class="form-group">
							<label for="inputTelefono">Telefono<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="telefono" id="inputTelefono" placeholder="Solo números, sin espacios ni guiones o paréntesis">
							<div id="campoTelefono">
							</div>
						</div>
						<div class="form-group">
							<label>Domicilio<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input type="text" class="form-control" name="domicilioCalle" id="inputCalle" placeholder="Calle"/>
								<input type="text" class="form-control" name="domicilioNumero" id="inputNumero" placeholder="Numero"/>
								<input type="text" class="form-control" name="domicilioPiso" id="inputPiso" placeholder="Piso (opcional)"/>
								<input type="text" class="form-control" name="domicilioDepto" id="inputDepto" placeholder="Depto (opcional)">				
							</div>
							<div id="campoDomicilio">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword">Contraseña<span class="text-danger">*</span></label>
							<input type="password" class="form-control" name="pass" id="inputPassword" placeholder="entre 6 y 20 caracteres, al menos una letra mayúscula, una minúscula y un caracter especial o número">
							<div id="campoPassword">
							</div>
						</div>
						<div class="form-group">
							<label for="inputRepetirPassword">Repetir Contraseña<span class="text-danger">*</span></label>
							<input type="password" class="form-control" id="inputRepetirPassword">
							<div id="campoRepetirPassword">
							</div>
						</div>
						<p class="text-danger">*Campo obligatorio</p>
						<button type="button" id="btn_registro" class="btn btn-danger">Registrarse</button>
					</form>
				</div>
			</div>
		</section>
		<footer>
			<div class="container">
				<div class="col-md-8 col-md-offset-3">
					<h2>Sistema de Subastas Bestnid</h2>
				</div>
			</div>
		</footer>
	</body>
</html>