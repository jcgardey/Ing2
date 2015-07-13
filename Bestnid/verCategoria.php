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
		<?php 
			include ("navbarAdmin.html"); 
			
			//chequeo de parámetros
			if (!isset($_GET["id"]) ) {
				header("Location: listadoCategorias.php");
			}
			
			include("conexion.php");
			//chequear que no existan productos de la categoria a eliminar y que la categoria exista
			$existenProductos = mysqli_query($link, "SELECT * FROM Producto WHERE idCategoria='".$_GET["id"]."' ");
			
			$existeCategoria = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");
							
			if (mysqli_num_rows($existenProductos)>0 || mysqli_num_rows($existeCategoria)==0  ) {
				header("Location: listadoCategorias.php");
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
		        <div class="col-md-10 well well-lg">
					<div class="col-md-3">
						<h2>Confirmar eliminaci&oacute;n</h2>
					</div>
					<div class="col-md-7">
						<?php 
							include("conexion.php");
							

							$result= mysqli_query ($link, "SELECT * FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");
							$rowCat= mysqli_fetch_array($result);
						?>
						<h1><?php echo $rowCat["nombre"]; ?></h1>
						<h3>Descripci&oacute;n:</h3>
						<p class='lead'><?php echo $rowCat["descripcion"]; ?></p>
						<a class="btn btn-lg btn-danger" href=<?php echo "eliminarCategoria.php?id=".$_GET["id"]."";?> >Confirmar</a>
						<a class="btn btn-lg btn-default" href="listadoCategorias.php">Cancelar</a>
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