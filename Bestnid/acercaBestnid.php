<?php session_start(); ?>
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
			if (isset($_SESSION["admin"]) && $_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			elseif (isset($_SESSION["admin"]) && $_SESSION["admin"]==false) {
				include ("navbar.html"); 
			} else {
				include ("navbarIndex.html");
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
		        <div class="col-sm-3 col-md-9">
		        	<img src="logo.png">
		        	<h3><strong>Acerca de Bestnid</strong></h3>	
		        	<p class="text-danger text-justify">
			        	Bestnid es considerado un remate, pero un tanto particular. En Bestnid el bien subastado no se adjudica al 
						postor que más dinero haya ofrecido por él, sino que cada postor comunica por qué necesita dicho 
						producto, y el subastador elegirá un ganador en función de las necesidades expresadas por los ofertantes.
						Los ofertantes igualmente ofrecerán dinero pero el subastador no podrá verlo. Solo podrá ver el monto ofrecido
						por el ganador de la subasta una vez que lo elija.
		        	</p>
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