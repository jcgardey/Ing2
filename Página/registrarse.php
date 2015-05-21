<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Registrarse en Bestnid</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="estilopropio.css">
		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarRegistro.js"></script>
	</head>
	<body>
		<?php
			if (isset($_GET["error"]) && $_GET["error"]=="si") {
				echo "error al ingresar los datos del registro!";
			}
		?>
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
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php			          
									include("conexion.php");
									$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
									while ($row=mysqli_fetch_array($result) ) {
											echo "<li><a href=#>".$row["nombre"]."</a></li>";
									}
									?>	  
								</ul>
							</li>
						</ul>
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
						<form class="navbar-form navbar-right" id="formulario" action="validarSesion.php" method="POST">
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail3">User</label>
								<input name="input_user" type="email" class="form-control" id="exampleInputEmail3" placeholder="Usuario">
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword3">Password</label>
								<input name="input_password" type="password" class="form-control" id="exampleInputPassword3" placeholder="Contraseña">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember me
								</label>
							</div>
							<button type="submit" class="btn btn-danger">Sign in</button>
							<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="si") ) { ?>
									<div class="alert alert-danger" role="alert">Datos erroneos!!</div>
							<?php } ?>
						</form>
					</div>
				</div><!-- /.container-fluid -->
			</nav>
		</header>		
		<section class="main">
			<div class="container">	
				<div class="row">
					<div class="col-md-3">
						<h2>Crea tu cuenta en Bestnid</h2>
					</div>
				  	<div class="col-md-9">
				  		<form name="frm-registro" action="validarRegistro.php" method="post">
							  <div class="form-group">
								    <div id="campoNombres">
								    	<label for="inputNombres">Nombres</label>
								    	<input type="text" class="form-control" id="inputNombres" placeholder="Ingresa tus nombres">
							  		</div>
							  </div>
							   <div class="form-group">
								    <label for="inputApellidos">Apellidos</label>
								    <input type="text" class="form-control" id="inputApellidos" placeholder="Ingresa tus apellidos">
							  </div>
							  <div class="form-group">
								    <label for="inputEmail">Email</label>
								    <input type="email" class="form-control" id="inputEmail" placeholder="Ingresa tu email">
							  </div>
							   <div class="form-group">
								    <label for="inputTelefono">Telefono</label>
								    <input type="text" class="form-control" id="inputTelefono" placeholder="Ingresa tu telefono">
							  </div>
							   <div class="form-group">
								    <label for="inputDomicilio">Domicilio</label>
								    <input type="text" class="form-control" id="inputDomicilio" placeholder="Ingresa tu domicilio">
							  </div>
							  <div class="form-group">
								    <label for="inputPassword">Password</label>
								    <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
							  </div>
							  <input type="button" id="b_registrarse" class="btn btn-danger" value="Registrarse" />
						</form>
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