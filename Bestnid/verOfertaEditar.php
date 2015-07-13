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
			//chequeo de parametros
			if (!isset($_POST["idOferta"]) || !isset($_POST["monto"])) {
				header("Location: home.php");
			}

			include ("conexion.php");
			//chequear que la oferta exista, que el dueño es el usuario logueado y que la subasta a la cual pertenece la oferta este activa
			$datosOferta = mysqli_query ($link, "SELECT Subasta.idSubasta, Producto.nombre,Producto.imagen, Producto.descripcion, Oferta.idOferta,
				Oferta.monto, Oferta.razon 
				FROM Oferta INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta
				INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto 
				INNER JOIN Usuario ON Usuario.idUsuario=Oferta.idUsuario WHERE Oferta.idOferta='".$_POST["idOferta"]."'
				and Oferta.idUsuario='".$_SESSION["idUsuario"]."' and Subasta.estado='activa' ") or die (mysqli_error($link));

			if (mysqli_num_rows($datosOferta)==0) {
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
					<h2 class="text-center">Editar Oferta</h2>
					<div class="row well well-lg">
						<?php
	                     	$row= mysqli_fetch_array ($datosOferta);
	                    ?>
						<div class="col-md-8">
							<h3>Nombre del Producto:</h3>
							<p class='lead'><?php echo $row["nombre"]; ?></p>
							<h3>Descripci&oacute;n del Producto:</h3>
							<p class='lead'><?php echo $row["descripcion"]; ?></p>
							<h3>Raz&oacute;n:</h3>
							<p class='lead'><?php echo $row["razon"]; ?></p>
							<h3>Monto:</h3>
							<p class='lead'>$<?php echo $_POST["monto"]; ?></p>
							<a class="btn btn-lg btn-danger" href='<?php echo "editarOfertaBD.php?idOferta=".$row["idOferta"]."
							&monto=".$_POST["monto"]." ";?>'>Editar</a>
							<a class="btn btn-lg btn-default" href="home.php">Cancelar</a>
						</div>
						<div class="col-md-3">
							<img src='<?php echo $row["imagen"]; ?>' class="img-responsive" alt="imagen" />
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