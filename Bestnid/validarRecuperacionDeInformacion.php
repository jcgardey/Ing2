
<?php
	//chequear que esten todos los parámetros necesarios y que ingrese un usuario logueado a esta página
	session_start();
	if (isset($_SESSION["autentificado"]) || !isset($_POST["nombreUsuario"]) || !isset($_POST["e_mail"]) ) {
		header ("Location: index.php");
	}
	
	include("conexion.php");
	$datosUsuario= mysqli_query ($link, "SELECT * FROM Usuario WHERE nombre_usuario='".$_POST["nombreUsuario"]."' and 
	e_mail='".$_POST["e_mail"]."' ") or die(mysqli_error($link));

	if (mysqli_num_rows($datosUsuario)==0) {
		header ("Location:recuperarInformacion.php?errorRecuperacion=si");
	}
	else {
		$tuplaUsuario = mysqli_fetch_array($datosUsuario);

		if (isset($_POST["confirmacionEmail"]) and $_POST["confirmacionEmail"]=="1") {

			$to =$tuplaUsuario["e_mail"];
			$subject = "Confirmación de Bestnid para ".$tuplaUsuario["nombre_usuario"]." ";
			$headers = '';
			$headers = 'MIME-Version: 1.0'.PHP_EOL;
			$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL;
			$headers .= 'From: bestnid@gmail.com <From: bestnid@gmail.com>'.PHP_EOL;
			$message = "Haga click en el enlace que aparece debajo para activar su cuenta de Bestnid \n";
			$message .= "http://localhost/xampp/Bestnid/validarConfirmacionEmail.php?key=".$tuplaUsuario["codigoActivacion"]."";
			$sentmail =  mail($to,utf8_decode($subject),utf8_decode($message),utf8_decode($headers));
		} 
		
		if (isset($_POST["recuperacionContraseña"]) and $_POST["recuperacionContraseña"]=="2") {
			
			$to =$tuplaUsuario["e_mail"];
			$subject = "Recuperar contraseña de Bestnid para ".$tuplaUsuario["nombre_usuario"]." ";
			$headers = '';
			$headers = 'MIME-Version: 1.0'.PHP_EOL;
			$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL;
			$headers .= 'From: bestnid@gmail.com <From: bestnid@gmail.com>'.PHP_EOL;
			$message = "La contraseña de la cuenta de Bestnid del usuario ".$tuplaUsuario["nombre_usuario"]." es:\n";
			$message .= $tuplaUsuario["password"];
			$sentmail = mail($to,utf8_decode($subject),utf8_decode($message),utf8_decode($headers));
		}
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
		        	<h3>Se han enviado el/los email/s correspondiente/s a <?php echo $_POST["e_mail"]; ?> para recuperar los datos de la cuenta</h3>
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