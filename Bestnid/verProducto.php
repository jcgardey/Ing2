<?php include("session.php"); ?>
<DOCTYPE html>
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
			if (!isset($_GET["nombre"]) || !isset($_GET["cate"]) || !isset($_GET["desc"]) || !isset($_GET["fecha"]) ) {
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
					<div class="row well well-lg">
						<div class="col-md-3">
							<h2>Finaliza tu Producto</h2>
						</div>
						<div class="col-md-6">
							<h1><?php echo $_GET["nombre"]; ?></h1>
							<h3>Descripci&oacute;n:</h3>
							<p class='lead text-justify'><?php echo $_GET["desc"]; ?></p>
							<h3>Categor&iacute;a:</h3>
							<p class='lead'><?php echo $_GET["cate"]; ?></p>
							<h3>Fecha de Cierre:</h3>
							<p class='lead'><?php echo $_GET["fecha"]; ?></p>

							<a class="btn btn-lg btn-danger" href="<?php echo "subprodBD.php?nombre=".$_GET["nombre"]."&fecha=".$_GET["fecha"]."&imagen=".$_GET["imagen"]."&desc=".$_GET["desc"]."&cate=".$_GET["cate"];?>">Finalizar</a>
							<a class="btn btn-lg btn-default" href="altaProducto.php">Reiniciar</a>
						</div>
						<div class="col-md-3">
							<img src='<?php echo $_GET["imagen"]; ?>' class="img-responsive" alt="imagen" />
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