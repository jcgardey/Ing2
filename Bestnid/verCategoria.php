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
			
			//chequear que la categoria exista
			include("conexion.php");
			$result = mysqli_query ($link, "SELECT * FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");

			if (mysqli_num_rows($result)==0) {
				ader("Location: listadoCategorias.php");
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
		        <div class="col-md-10 well well-lg">
					<div class="col-md-3">
						<h2>Confirmar eliminaci&oacute;n</h2>
					</div>
					<div class="col-md-7">
						<?php 
							include("conexion.php");
							$result= mysqli_query ($link, "SELECT * FROM Categoria WHERE idCategoria='".$_GET["id"]."' and nombre='Otros' ");
			
							if (mysqli_num_rows($result)>0) {
								header("Location:listadoCategorias.php"); // no se puede eliminar la categoria Otros
							}

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