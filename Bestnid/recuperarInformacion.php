<?php 
	//ningun usuario logueado puede ingresar a esta página
	session_start();
	if (isset($_SESSION["autentificado"]) ) {
		header ("Location: home.php");
	}
?>
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
		<script>
			
			function validarCheckboxs () {
				if (!document.getElementById("r_confirmacion").checked && !document.getElementById("r_contraseña").checked) {
					document.getElementById("campoCheckbox").innerHTML = "<p class='text-danger'>Debe ingresar alguna opción</p>";
					return false;
				}
				return true;
			}

			function validarFormularioRecuperacion () {
				if (validarCampoObligatorio("inputNombreUsuario", "campoNombreUsuario") && validarCampoObligatorio("inputEmail","campoEmail") && validarCheckboxs() ) {
					document.getElementById("f_recuperacion").submit();
				}
			}


			window.onload = function () {
				document.getElementById("btnConfirmar").onclick = validarFormularioRecuperacion;
			}
		</script>		
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
				<div class="col-md-4 col-md-offset-2">
					<h3>Recuperar informaci&oacute;n de su cuenta</h3>
					<form name="frm-recuperacion" id="f_recuperacion" action="validarRecuperacionDeInformacion.php" method="POST">
						<div class="form-group">
							<label for="inputNombreUsuario">Nombre de Usuario<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="nombreUsuario" id="inputNombreUsuario" placeholder="Usuario">
							<div id="campoNombreUsuario">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Email<span class="text-danger">*</span></label>
							<input type="text" name="e_mail" class="form-control" id="inputEmail" placeholder="Correo Electrónico">
							<div id="campoEmail">
							</div>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="confirmacionEmail" id="r_confirmacion" value="1">Email de confirmaci&oacute;n de cuenta
							</label>
							<label>
								<input type="checkbox" name="recuperacionContraseña" id="r_contraseña" value="2">Contraseña de usuario
							</label>
							<div id="campoCheckbox">
							</div>
						</div>
						<?php
							if ( (isset($_GET["errorRecuperacion"]) ) && ($_GET["errorRecuperacion"]=="si") ) { ?>
								<p class="text-danger">Direcci&oacute;n de correo electr&oacute;nico o nombre de usuario incorrectos!</p>
						<?php } ?>
						<button type="button" class="btn btn-danger" id="btnConfirmar">Confirmar</button>
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