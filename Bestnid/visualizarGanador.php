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
			
			
			if (!isset($_GET["idOferta"]) || !isset($_GET["idSubasta"]) ) {
				header("Location:home.php");
			}			

			if ($_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			else {
				include ("navbar.html"); 
			}
			//buscar los datos de la oferta ganadora para mostrarlos y del usuario que la realizó para mostrarlos
						$result= mysqli_query ($link, "SELECT * FROM Venta INNER JOIN Oferta ON Oferta.idOferta=Venta.idOferta 
						INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario WHERE Venta.idOferta='".$_GET["idOferta"]."' and Oferta.idSubasta='".$_GET["idSubasta"]."' ");

						$rowOf=mysqli_fetch_array($result);

						if (mysqli_num_rows($result)>0) {
							//si la oferta corresponde a una oferta ganadora de la subasta enviada por parámetro, se debe chequear que el dueño de la misma sea el usuario logueado
							$result2= mysqli_query ($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");

							//si el usuario logueado no es el dueño de la subasta y tampoco es el administrador no se puede ver el ganador
							if (mysqli_num_rows($result2)==0 && $_SESSION["admin"]==false) {
								header("Location: home.php");
							}
						}
						//si la oferta no existe..
						else {
							header("Location:home.php");
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
						
					?>
					<div class="row well well-lg">
						<div class="col-md-3">
							<h2><strong>Ganador Elegido</strong></h2>
						</div>
						<div class="col-md-9">
							<h3><strong>Raz&oacute;n:</strong></h3>
							<p class='lead'><?php echo $rowOf["razon"]; ?></p>
							<h3>Monto de la oferta:</h3>
							<p class='lead'>$<?php echo $rowOf["monto"]; ?></p>
							<h3><strong>Datos del usuario ganador: </strong></h3>
							<p class='lead'><?php echo "".$rowOf["nombre"]." ".$rowOf["apellido"]." "; ?></p>
							<p class='lead'><?php echo "".$rowOf["telefono"]." ".$rowOf["e_mail"]." "; ?></p>
							<p class='lead'>Calle: <?php echo $rowOf["calle"] ?>
								 N&uacute;mero: <?php echo $rowOf["numero_calle"] ?>
								 <?php 
									 if ($row["piso"]!="") {
									 	echo "Piso: ".$rowOf["piso"]." ";
									 } 
									 if ($row["depto"]!="") {
									 	echo "Depto: ".$rowOf["depto"]." ";
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