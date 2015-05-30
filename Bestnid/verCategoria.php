<?php include ("sessionAdmin.php"); ?>
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
		<script src="Bootstrap/js/validarRegistro.js"></script>
	
	</head>
	<body>
		<?php includes ("navbarAdmin.php"); ?>
		<section class="main container">
			<div class="row">
				<div class="col-md-3">
					<h2>Confirmar eliminacio&acute;n</h2>
				</div>
				<div class="row well well-lg">
					<div class="col-md-6">
					<h1><?php echo $_GET["nombreCategoria"]; ?></h1>
					<h3>Descripcion:</h3>
					<p class='lead'><?php echo $_GET["descripcion"]; ?></p>
					<a class="btn btn-lg btn-danger" href=<?php echo "eliminarCategoria.php?id=".$_GET["id"]."";?> >Confirmar</a>
					<a class="btn btn-lg btn-default" href="listadoCategorias.php">Cancelar</a>
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