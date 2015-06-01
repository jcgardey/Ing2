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
					<h2>Finaliza tu Oferta</h2>
				</div>
				<div class="row well well-lg">
					<?php
                    	include ("conexion.php");
                    	$result = mysqli_query ($link,"SELECT * FROM Subasta INNER JOIN Producto ON  
                    		Subasta.idProducto = Producto.idProducto WHERE 
                    		Subasta.idSubasta='".$_POST["idSubasta"]."' ");
                     	$row= mysqli_fetch_array ($result);
                    ?>
					<div class="col-md-6">
						<h3>Nombre del Producto:</h3>
						<p class='lead'><?php echo $row["nombre"]; ?></p>
						<h3>Descripci&oacute;n del Producto:</h3>
						<p class='lead'><?php echo $row["descripcion"]; ?></p>
						<h3>Raz&oacute;n:</h3>
						<p class='lead'><?php echo $_POST["razon"]; ?></p>
						<h3>Monto:</h3>
						<p class='lead'>$<?php echo $_POST["monto"]; ?></p>
						<a class="btn btn-lg btn-danger" href="<?php echo "altaOfertaBD.php?monto=".$_POST["monto"]."
						&razon=".$_POST["razon"]."
						&idSubasta=".$_POST["idSubasta"]." "; ?>" >Finalizar</a>
						<a class="btn btn-lg btn-default" href=<?php echo "altaOferta.php?idSubasta=".$_POST["idSubasta"]." ";?> >Reiniciar</a>
					</div>
					<div class="col-md-3">
						<img src=<?php echo $row["imagen"]; ?> style=" max width:300px; max height:200px;" class="img-responsive" alt="imagen" />
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