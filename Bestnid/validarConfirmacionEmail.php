<?php	
	if (!isset($_GET["key"])) {
		header ("Location: home.php");
	}
	include ("conexion.php");
	$datosUsuario= mysqli_query ($link, "SELECT * FROM Usuario WHERE codigoActivacion='".$_GET["key"]."' ") or die (mysqli_error($link));
	if (mysqli_num_rows($datosUsuario)==1) {
		$datosU= mysqli_fetch_array($datosUsuario);
		session_start();
		$_SESSION["admin"]=false;	
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]= $datosU["nombre_usuario"];
		$_SESSION["idUsuario"]= $datosU["idUsuario"];
		
		$actualizarConfirmacion = mysqli_query($link, "UPDATE Usuario SET confirmado=1 WHERE idUsuario='".$datosU["idUsuario"]."' ") or die(mysqli_error($link));
	}
	else {
		header("Location: index.php");
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
		<?php include("navbar.html"); ?>
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
		        	<h4><strong>¡<?php echo $datosU["nombre"]; ?> BIENVENIDO A BESTNID!</strong></h4>
		        	<h5>Ya pod&eacute;s utilizar tu cuenta</h5>
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