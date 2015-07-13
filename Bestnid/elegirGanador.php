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
		        	<?php			          
						//las ofertas que fueron reportadas no pueden ser elegidas como ganadoras
						include("conexion.php");
						$result = mysqli_query ($link, "SELECT Oferta.idUsuario,Oferta.idOferta,Oferta.razon,Usuario.nombre_usuario FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario
							WHERE idSubasta='".$_GET["idSubasta"]."' and Oferta.reportada=0 ");
						while ($row=mysqli_fetch_array($result) ) {
							echo "<div class='panel panel-default row'>
  									<div class=panel-body>
  										<div class='col-md-11'>
	  										<div class='row'>
	    										<a href='verPerfilDeUsuario.php?idUsuario=".$row["idUsuario"]."'>".$row["nombre_usuario"]."</a>
	    									</div>
	    									<div class='row'>
	    										<p class='lead'>".$row["razon"]."</p>
	    									</div>
	    								</div>
    									<div class='col-md-1'>
    										<a class='btn btn-danger' href='confirmarGanador.php?idOferta=".$row["idOferta"]."&idSubasta=".$_GET["idSubasta"]." ' role='button'>Elegir</a>
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