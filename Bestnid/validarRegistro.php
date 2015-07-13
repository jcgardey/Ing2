
<?php
	//chequear que esten todos los parámetros necesarios y que ingrese un usuario logueado a esta página
	session_start();
	if (isset($_SESSION["autentificado"]) || !isset($_POST["nombres"]) || !isset($_POST["apellidos"]) || !isset($_POST["telefono"]) || !isset($_POST["nombreUsuario"]) ||
		!isset($_POST["pass"]) || !isset($_POST["e_mail"]) || !isset($_POST["domicilioCalle"]) || !isset($_POST["domicilioNumero"]) ||
		!isset($_POST["domicilioPiso"]) || !isset($_POST["domicilioDepto"]) 
		) {
		header ("Location: index.php");
	}

	include("conexion.php");
	$result = mysqli_query ($link, "SELECT * FROM Usuario WHERE nombre_usuario='".$_POST["nombreUsuario"]."' ");
	$num = mysqli_num_rows($result);
	if ($num  != 0) { 
			header("Location: registrarse.php?errorUsuario=si");
	}
	else {
			$codigoActivacion = md5(uniqid(rand()));
			$resultado = mysqli_query ($link, "INSERT INTO `bestnid`.`usuario` (`nombre`,`apellido`,`telefono`, `nombre_usuario`,
				`password`, `e_mail`, `confirmado`, `estado`,`calle`,`numero_calle`,`piso`,`depto`, `codigoActivacion`) VALUES ('".$_POST["nombres"]."',
			'".$_POST["apellidos"]."', '".$_POST["telefono"]."', '".$_POST["nombreUsuario"]."', '".$_POST["pass"]."',
			'".$_POST["e_mail"]."', 0, 'activo', '".$_POST["domicilioCalle"]."', '".$_POST["domicilioNumero"]."',
			 '".$_POST["domicilioPiso"]."','".$_POST["domicilioDepto"]."',  '".$codigoActivacion."' )" ) or die(mysqli_error($link));
	
			$to = $_POST["e_mail"];
			$subject = "Confirmación de Bestnid para ".$_POST["nombreUsuario"]." ";
			$header = "Bestnid: Activar la cuenta de ".$_POST["nombreUsuario"]." ";
			$message = "Haga click en el enlace que apara debajo para activar su cuenta de Bestnid \n";
			$message .= "http://localhost/xampp/Bestnid/validarConfirmacionEmail.php?key=".$codigoActivacion." ";
			$sentmail = mail($to,$subject,$message,$header);
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
		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
	</head>
	<body>
		<?php include("navbarIndex.html"); ?>
		<section class="main container-fluid">
			<div class="row">	
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
		        <div class="col-sm-3 col-md-9">
		        	<h3>Se ha enviado un email a <?php echo $_POST["e_mail"]; ?> para realizar la activaci&oacute;n de la cuenta</h3>
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
							<li><a href="Ayuda.pdf">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>