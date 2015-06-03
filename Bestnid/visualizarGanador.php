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
			
			//chequear que el usuario logueado es quien realmente hizo la subasta, que la subasta haya finalizado o este cerrada y que la oferta exista
			$result=mysqli_query($link, " SELECT * FROM Subasta INNER JOIN Oferta ON Oferta.idSubasta=Subasta.idSubasta 
				WHERE idOferta='".$_GET["idOferta"]."' and Subasta.idUsuario='".$_SESSION["idUsuario"]."' and (estado='finalizada' or estado='cerrada') " );

			$rowSubasta=mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result)==0 || !isset($_GET["idOferta"])) {
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
			            <li class="active"><a class="text-danger" href="#"><strong>Categorias</strong></a></li>
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger' href='listadoProductosPorCategoria.php?nombre=".$row["nombre"]." '>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </div>
				<div class="col-md-9">
					<?php

						//buscar los datos de la oferta y del usuario que la realizó para mostrarlos
						$result= mysqli_query ($link, "SELECT * FROM Usuario INNER JOIN Oferta ON Oferta.idUsuario=Usuario.idUsuario 
						WHERE idOferta='".$_GET["idOferta"]."' ");

						$row=mysqli_fetch_array($result);

						//se guardan los datos del cierre de la subasta únicamente si esta está finalizada
						if ($rowSubasta["estado"]=='finalizada') {	
							
							$result = mysqli_query ($link, "SELECT valor FROM Configuracion WHERE clave='porcentaje'");
							
							$rowConf = mysqli_fetch_array($result);
							
							$result = mysqli_query ($link, "INSERT INTO `bestnid`.`venta`(`fecha`,`porcentaje`,`idOferta`)
								VALUES (current_date(),CONVERT('".$rowConf["valor"]."',unsigned), '".$row["idOferta"]."' )");

							
							//cambiar el estado de la subasta
							$result= mysqli_query ($link, "UPDATE Subasta SET estado='cerrada' WHERE estado='finalizada' and idSubasta=(SELECT idSubasta FROM Oferta WHERE idOferta='".$row["idOferta"]."') ");
						}
					
					?>
					<div class="row well well-lg">
						<div class="col-md-3">
							<h2><strong>Ganador Elegido</strong></h2>
						</div>
						<div class="col-md-9">
							<h3><strong>Raz&oacute;n:</strong></h3>
							<p class='lead'><?php echo $row["razon"]; ?></p>
							<h3>Monto de la oferta:</h3>
							<p class='lead'>$<?php echo $row["monto"]; ?></p>
							<h3><strong>Datos del usuario ganador: </strong></h3>
							<p class='lead'><?php echo "".$row["nombre"]." ".$row["apellido"]." "; ?></p>
							<p class='lead'><?php echo "".$row["telefono"]." ".$row["e_mail"]." "; ?></p>
							<p class='lead'>Calle: <?php echo $row["calle"] ?>
								 N&uacute;mero: <?php echo $row["numero_calle"] ?>
								 <?php 
									 if ($row["piso"]!="") {
									 	echo "Piso: ".$row["piso"]." ";
									 } 
									 if ($row["depto"]!="") {
									 	echo "Depto: ".$row["depto"]." ";
									 } 
								 ?> 
							 </p>
							<br />
							<div>
								<a class="btn btn-lg btn-default" href="home.php">Continuar</a>
							</div>
						</div>
					</div>				  	
				</div>
			</div>
		</section>
		<footer class="btn-danger">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-3">
						<h2>Sistema de Subastas Bestnid</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 col-md-offset-2">
						<a href="home.php">Home</a>
					</div>
					<div class="col-md-2 col-md-offset-2">
						<a href="#">Ayuda</a>
					</div>
					<div class="col-md-2 col-md-offset-2">
						<a href="#">Acerca de Bestnid</a>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>