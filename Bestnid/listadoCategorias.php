<?php include("sessionAdmin.php"); ?>
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
		<?php include ("navbarAdmin.html"); ?>
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
		        	<div class="row">
		        		<div class="col-md-3 col-md-offset-5">
		        			<a class="btn btn-danger" href="altaCategoria.php">Ingresar categoria</a>
		        		</div>
		        	</div>
		        	<br />
		        	<?php			          
						include("conexion.php");
						$result = mysqli_query ($link, "SELECT * FROM Categoria");
						while ($row=mysqli_fetch_array($result) ) {
							$productosCategoria = mysqli_query ($link, "SELECT * FROM Producto WHERE idCategoria='".$row["idCategoria"]."' ");
							echo "<div class='panel panel-default row'>
  									<div class=panel-body>
  										<div class='col-md-10'>
    										".$row["nombre"]."
    									</div>
    									<div class='col-md-1'>
    										<a class='btn btn-danger' href='editarCategoria.php?id=".$row["idCategoria"]."' role='button'>Editar</a>
    									</div>";
    								//si una categoria posee productos no se debe mostrar el botón eliminar
    								if (mysqli_num_rows($productosCategoria)==0) {
    									echo
    									"<div class='col-md-1'>
    										<a class='btn btn-danger' href='verCategoria.php?id=".$row["idCategoria"]."' role='button'>Eliminar</a>
    									</div>";
    								}
  								  	echo
  								  	"</div>
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
							<li><a href="Ayuda.pdf">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>