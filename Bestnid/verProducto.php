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
			if ($_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			else {
				include ("navbar.html"); 
			}
		?>
		<section class="main container">
			<div class="row">
				<div class="col-md-3">
					<h2>Finaliza tu Producto</h2>
				</div>
				<div class="row well well-lg">
					<div class="col-md-6">
					<h1><?php echo $_GET["nombre"]; ?></h1>
					<h3>Descripcion:</h3>
					<p class='lead'><?php echo $_GET["desc"]; ?></p>
					<h3>Categoria:</h3>
					<p class='lead'><?php echo $_GET["cate"]; ?></p>
					<h3>Fecha de Cierre:</h3>
					<p class='lead'><?php echo $_GET["fecha"]; ?></p>

					<a class="btn btn-lg btn-danger" href="<?php echo "subprodBD.php?nombre=".$_GET["nombre"]."&fecha=".$_GET["fecha"]."&imagen=".$_GET["imagen"]."&desc=".$_GET["desc"]."&cate=".$_GET["cate"];?>">Finalizar</a>
					<a class="btn btn-lg btn-default" href="altaProducto.php">Reiniciar</a>
					</div>
					<div class="col-md-3">
						<img src=<?php echo $_GET["imagen"]; ?> class="img-circle img-responsive" alt="imagen" />
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="container">
				<div class="col-md-8 col-md-offset-3">
					<h2>Sistema de Subastas Bestnid</h2>
				</div>
			</div>
		</footer>
	</body>
</html>