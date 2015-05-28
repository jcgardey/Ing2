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

		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarRegistro.js"></script>
	
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
					<h2>Confirmar eliminacio&acute;n</h2>
				</div>
				<div class="row well well-lg">
					<div class="col-md-6">
					<h1><?php echo $_GET["nombreCategoria"]; ?></h1>
					<h3>Descripcion:</h3>
					<p class='lead'><?php echo $_GET["descripcion"]; ?></p>
					<a class="btn btn-lg btn-danger" href=<?php echo "eliminarCategoria.php?id=".$_GET["id"]."";?> >Confirmar</a>
					<a class="btn btn-lg btn-default" href="listadoCategorias.php">Cancelar</a>
					</div>
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