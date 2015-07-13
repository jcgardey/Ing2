<?php include("session.php"); ?>
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
		<?php 
			
			include ("conexion.php");
			
			if (!isset($_GET["idOferta"])) {
				header("Location:home.php");
			}
			//chequear que el usuario logueado es quien realmente hizo la subasta, que la subasta haya finalizado, que la oferta existe y que no está reportada
			$result=mysqli_query($link, " SELECT * FROM Subasta INNER JOIN Oferta ON Oferta.idSubasta=Subasta.idSubasta 
				WHERE idOferta='".$_GET["idOferta"]."' and Oferta.reportada=0 and Subasta.idUsuario='".$_SESSION["idUsuario"]."' and estado='finalizada' " );


			if (mysqli_num_rows($result)==0) {
				header("Location:home.php");
			}
			

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
				<div class="col-md-9">
					<?php

						$result= mysqli_query ($link, "SELECT Subasta.idSubasta, Producto.nombre AS nomProd, Producto.descripcion, Producto.imagen, Oferta.fecha, Oferta.razon, Oferta.monto, Usuario.nombre_usuario,Usuario.idUsuario
						FROM Subasta INNER JOIN Oferta ON Subasta.idSubasta=Oferta.idSubasta 
						INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario
					 	WHERE idOferta='".$_GET["idOferta"]."' ");
						
						$row=mysqli_fetch_array($result);
					?>
					<div class="row well well-lg">
						<div class="col-md-3">
							<h2><strong>Confirmar Ganador</strong></h2>
						</div>
						<div class="col-md-6">
							<h1><?php echo $row["nomProd"]; ?></h1>
							<h3>Descripci&oacute;n:</h3>
							<p class='lead'><?php echo $row["descripcion"]; ?></p>
							<h3>Fecha de Realizaci&oacute;n de la oferta:</h3>
							<p class='lead'><?php echo date('d-m-Y',strtotime($row["fecha"])); ?></p>
							<h3>Usuario que la realiz&oacute;: </h3>
							<div>
								<a href='<?php echo "verPerfilDeUsuario.php?idUsuario=".$row["idUsuario"]." ";?>' class="lead"><?php echo $row["nombre_usuario"]; ?></a>
							</div>
							<br />
							<div>
								<a class="btn btn-lg btn-danger" href='guardarGanador.php?<?php echo "idOferta=".$_GET["idOferta"]."&idSubasta=".$_GET["idSubasta"].""; ?>'>Finalizar</a>
								<a class="btn btn-lg btn-default" href='elegirGanador.php?idSubasta=<?php echo $row["idSubasta"]; ?> '>Cancelar</a>
							</div>
						</div>
						<div class="col-md-3">
							<img src='<?php echo $row["imagen"]; ?>' class="img-responsive" alt="imagen" />
						</div>
					</div>
					<h3><strong>Oferta Elegida</strong></h3>
					<div class='panel panel-default row'>
		  				<div class='panel-body container-fluid'>
		  					<p class='lead'><?php echo $row["razon"]; ?></p>
		  				</div>
		  			</div>				  	
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