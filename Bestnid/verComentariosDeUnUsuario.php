<?php 
	include("session.php"); 
?>
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
		        <div class="col-sm-3 col-md-9">
		        	<?php			          
						include("conexion.php");
						
						$result = mysqli_query ($link, "SELECT Subasta.fecha_cierre,Subasta.estado,Subasta.idUsuario, Producto.imagen, Producto.nombre, Producto.descripcion, Categoria.nombre AS nomCat, Comentario.texto,Comentario.respuesta
							FROM Comentario INNER JOIN Subasta ON Comentario.idSubasta=Subasta.idSubasta INNER JOIN Producto ON
							Subasta.idProducto=Producto.idProducto INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria
							WHERE Comentario.idUsuario='".$_SESSION["idUsuario"]."'
						ORDER BY fecha_realizacion DESC") or die (mysqli_error($link));

						//en caso que el usuario no posea ofertas realizdas
						if (mysqli_num_rows($result)==0) {
							echo "<h3 class='text-danger'>No ha realizado ning&uacute;n comentario</h3>";
						}
						
						while ($row=mysqli_fetch_array($result) ) {
							echo "<div class='well well-sm row'>
  								  	<div class='row'>
  								  		<div class='col-md-2'>
    										<img src='".$row["imagen"]."' class='img-responsive' alt='imagen' />
    									</div>
    									<div class='col-md-4'>
    										<div class='row'>
    											<h3>".$row["nombre"]."</h3>
    										</div>
    										<div class='row'>
    											<h5><strong>Finaliza: </strong>".date('d-m-Y',strtotime($row["fecha_cierre"]))."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Estado: </strong>".$row["estado"]."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Categoría: </strong>".$row["nomCat"]."</h5>
    										</div>
    									</div>
    									<div class='col-md-6'>
    										<p>".$row["descripcion"]."</p>
    									</div>
  								  	</div>
  								  	<div>
  								  		<h4><strong>Mi comentario:</strong></h4>
  								  		<p>".$row["texto"]."</p>
  								  	</div>
  								  	<div>";		
  								if ($row["respuesta"]!="") {
  									echo "
  								  		<h4><strong>Respuesta:</strong></h4>
  								  		<p>".$row["respuesta"]."</p>";
  								}  	
  								else {
  									echo"
  										<h4><strong>No hay respuesta para este comentario</strong></h4>";
  								}
    								echo "
    								</div>
    							  </div>";			
						}
					?>
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