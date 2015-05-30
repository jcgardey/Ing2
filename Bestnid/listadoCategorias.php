<?php include("sessionAdmin.php"); ?>
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
		<?php include ("navbarAdmin.html"); ?>
		<section class="main container-fluid">
			<aside class="row">	
				<div class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			             <li class="active"><a class="text-danger" href="#"><strong>Categorias</strong></a></li>
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger' href=#>".$row["nombre"]."</a></li>";
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
							echo "<div class='panel panel-default row'>
  									<div class=panel-body>
  										<div class='col-md-10'>
    										".$row["nombre"]."
    									</div>
    									<div class='col-md-1'>
    										<a class='btn btn-danger' href='editarCategoria.php?nombreCategoria=".$row["nombre"]."&descripcion=".$row["descripcion"]."&id=".$row["idCategoria"]."' role='button'>Editar</a>
    									</div>
    									<div class='col-md-1'>
    										<a class='btn btn-danger' href='verCategoria.php?nombreCategoria=".$row["nombre"]."&descripcion=".$row["descripcion"]."&id=".$row["idCategoria"]."' role='button'>Eliminar</a>
    									</div>
  								  	</div>
								  </div>";
						}
					?>
		        </div>
		     </aside>
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