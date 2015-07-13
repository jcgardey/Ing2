<?php 
	include("session.php");
	include("conexion.php");
	if (!isset($_GET["idSubasta"])) {
		header("Location:home.php");
	}
	$subastaNoCerrada = mysqli_query($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and estado <> 'cerrada' ") or die (mysqli_error($link));

	//chequear que la subasta este cerrada
	if (mysqli_num_rows($subastaNoCerrada)==0) {
		header("Location:home.php");
	}
	else {
		//chequear que el subastador sea el usuario logueado o quien igrese a este sitio sea el administrador
		$tuplaSubasta=mysqli_fetch_array($subastaNoCerrada);
		if ($tuplaSubasta["idUsuario"]!=$_SESSION["idUsuario"] && !$_SESSION["admin"]) {
			header("Location:home.php");
		}
	}
	$datosSubasta=mysqli_query($link, "SELECT Subasta.idSubasta, Subasta.fecha_cierre, Producto.nombre, Producto.imagen, Producto.descripcion, Categoria.nombre AS nombreCategoria FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria WHERE Subasta.idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));
	$tuplaSubasta=mysqli_fetch_array($datosSubasta);
?>
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
					<div class="row well well-lg">
						<div class="col-md-3">
							<h2>Cancelar Subasta</h2>
						</div>
						<div class="col-md-6">
							<h1><?php echo $tuplaSubasta["nombre"]; ?></h1>
							<h3>Descripci&oacute;n:</h3>
							<p class='lead text-justify'><?php echo $tuplaSubasta["descripcion"]; ?></p>
							<h3>Categor&iacute;a:</h3>
							<p class='lead'><?php echo $tuplaSubasta["nombreCategoria"]; ?></p>
							<h3>Fecha de Cierre:</h3>
							<p class='lead'><?php echo date('d-m-Y',strtotime($tuplaSubasta["fecha_cierre"])); ?></p>

							<a class="btn btn-lg btn-danger" href="<?php echo "eliminarSubasta.php?idSubasta=".$_GET["idSubasta"].""; ?>">Confirmar</a>
							<a class="btn btn-lg btn-default" href="home.php">Cancelar</a>
						</div>
						<div class="col-md-3">
							<img src='<?php echo $tuplaSubasta["imagen"]; ?>' class="img-responsive" alt="imagen" />
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