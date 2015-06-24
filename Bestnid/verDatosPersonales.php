<?php
	include("session.php");
	include("conexion.php");
	$datosUsuario=mysqli_query ($link, "SELECT * FROM Usuario WHERE idUsuario='".$_SESSION["idUsuario"]."' ") or die(mysqli_error($link));

	if (mysqli_num_rows($datosUsuario)==0) {
		header ("Location: home.php");
	}

	$tuplaUsuario= mysqli_fetch_array($datosUsuario);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Bestnid</title>
		<link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="Bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="estilopropio.css">
		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarRegistro.js"></script>
		<script>
			function validarFormActualizar () {
				var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
				var expRegUsuario = /^[a-z\d_]{4,15}$/;
				var expRegMail=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
				var expRegTelefono=/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
				if ( (validarCampo(expRegNombre,"inputNombres","campoNombresyApellidos","solo se aceptan letras")) 
					&& (validarCampo(expRegNombre,"inputApellidos","campoNombresyApellidos","solo se aceptan letras"))
					&& (validarCampo(expRegMail,"inputEmail","campoEmail","debe cumplir con el formato alguien@ejemplo.com"))
					&& (validarCampo(expRegTelefono,"inputTelefono","campoTelefono","no es un numero de telefono válido"))
					&& (validarDomicilio())) {
					document.getElementById("f_actualizar").submit();
				}
			}


			window.onload = function () {
				document.getElementById("btn_actualizar").onclick=validarFormActualizar;
			}
		</script>		
	</head>
	<body>
		<?php 
			if ($_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			else {
				include ("navbar.html"); 
			}
		?>
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
				<div class="col-md-7 col-md-offset-1">
					<h3 class="text-center">Mis datos personales</h3>
					<form name="frm-actualizar" id="f_actualizar" action="actualizarDatosPersonales.php" method="POST">
						<div class="form-group">
							<label>Nombres y Apellidos<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input type="text" class="form-control" name="nombres" id="inputNombres" placeholder="Nombres" value='<?php echo $tuplaUsuario["nombre"]; ?>'>
								<input type="text" class="form-control" name="apellidos" id="inputApellidos" placeholder="Apellidos" 
								value=<?php echo $tuplaUsuario["apellido"]; ?>>
							</div>
							<div id="campoNombresyApellidos">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Usuario<span class="text-danger">*</span></label>
							<input type="text" name="nombreUsuario" class="form-control" id="inputUsuario" placeholder="entre 4 y 15 caracteres, letras y números" value='<?php echo $tuplaUsuario["nombre_usuario"]; ?>' readonly="readonly" >
							<div id="campoUsuario">
								<?php
								if ( (isset($_GET["errorUsuario"]) ) && ($_GET["errorUsuario"]=="si") ) { ?>
									<p class="text-danger">El nombre de usuario ya existe</p>
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="e_mail" id="inputEmail" placeholder="alguien@ejemplo.com"
							value='<?php echo $tuplaUsuario["e_mail"]; ?>'>
							<div id="campoEmail">
							</div>
						</div>
						<div class="form-group">
							<label for="inputTelefono">Telefono<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="telefono" id="inputTelefono" placeholder="Solo números, sin espacios ni guiones o paréntesis" value='<?php echo $tuplaUsuario["telefono"]; ?>'>
							<div id="campoTelefono">
							</div>
						</div>
						<div class="form-group">
							<label>Domicilio<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input type="text" class="form-control" name="domicilioCalle" id="inputCalle" placeholder="Calle"
								value='<?php echo $tuplaUsuario["calle"]; ?>'/>
								<input type="text" class="form-control" name="domicilioNumero" id="inputNumero" placeholder="Numero"
								value='<?php echo $tuplaUsuario["numero_calle"]; ?>'/>
								<input type="text" class="form-control" name="domicilioPiso" id="inputPiso" placeholder="Piso (opcional)"
								value='<?php echo $tuplaUsuario["piso"]; ?>' >
								<input type="text" class="form-control" name="domicilioDepto" id="inputDepto" placeholder="Depto (opcional)" value='<?php echo $tuplaUsuario["depto"]; ?>'>				
							</div>
							<div id="campoDomicilio">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword">Contraseña<span class="text-danger">*</span></label>
							<input type="password" class="form-control" name="pass" id="inPassword" placeholder="entre 6 y 20 caracteres, al menos una letra mayúscula, una minúscula y un caracter especial o número"
							value='<?php echo $tuplaUsuario["password"]; ?>' readonly="readonly">
							<div id="campoPassword">
							</div>
						</div>
						<p class="text-danger">*Campo obligatorio</p>
						<button type="button" id="btn_actualizar" class="btn btn-danger">Actualizar</button>
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