<?php include ("session.php"); ?>
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
			
			//chequear que el usuario logueado es quien realmente hizo la subasta y que la subasta haya finalizado
			include ("conexion.php");
			$result=mysqli_query($link, " SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' and estado='finalizada' " );
		
			//chequeo de parámetros
			if (!isset($_GET["idSubasta"]) || mysqli_num_rows($result)==0) {
				header("Location: home.php");
			}
			

			if ($_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			else {
				include ("navbar.html"); 
			}
		?>
		<section class="main container-fluid">
			<aside class="row">	
				<div class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			             <li class="active"><a class="text-danger" href="#"><strong>Categorias</strong></a></li>
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger' href=#>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </div>
		        <div class="col-sm-3 col-md-9">
		        	<?php			          
						include("conexion.php");
						$result = mysqli_query ($link, "SELECT * FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario
							WHERE idSubasta='".$_GET["idSubasta"]."' ");
						while ($row=mysqli_fetch_array($result) ) {
							echo "<div class='panel panel-default row'>
  									<div class=panel-body>
  										<div class='col-md-11'>
	  										<div class='row'>
	    										<a href='#'>".$row["nombre_usuario"]."</a>
	    									</div>
	    									<div class='row'>
	    										<p class='lead'>".$row["razon"]."</p>
	    									</div>
	    								</div>
    									<div class='col-md-1'>
    										<a class='btn btn-danger' href='confirmarGanador.php?idOferta=".$row["idOferta"]." ' role='button'>Elegir</a>
    									</div>
  								  	</div>
								  </div>";
						}
					?>
		        </div>
		     </aside>
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