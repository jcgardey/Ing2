<!DOCTYPE html>
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
		<?php include("navbarIndex.html"); ?>
		<section class="main container-fluid">
			<div class="main row">
				<div class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			            <li class="active"><a class="text-danger" href="home.php"><strong>Categorias</strong></a></li>
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT * FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger' href='listadoProductosPorCategoria.php?idCategoria=".$row["idCategoria"]." '>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </div>
				<div class="col-md-2">
					<h3>Sumate a Bestnid</h3>
				</div>
				<div class="col-md-8">
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
							<input type="password" class="form-control" name="pass" id="inPassword" placeholder="entre 6 y 20 caracteres, al menos una letra mayúscula, una minúscula y un caracter especial o número">
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
		<footer class="btn-danger">
			<div class="container">
				<div class="row">
					<h4 class="text-center">Sistema de Subastas Bestnid</h4>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>Luca Cucchetti - Juan Cruz Gardey - Brian C&eacute;spedes </p>
					</div>
					<div class="col-md-6">
						<ul class="list-inline text-right">
							<li><a href="home.php">Home</a></li>
							<li><a href="#">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>