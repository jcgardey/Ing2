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
						
						$result = mysqli_query ($link, "SELECT Oferta.idOferta,Oferta.razon,Oferta.monto,Oferta.idSubasta,Subasta.estado FROM OFerta INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta WHERE Oferta.idUsuario='".$_SESSION["idUsuario"]."'
						ORDER BY fecha DESC  ")
						or die (mysqli_error($link));

						//en caso que el usuario no posea ofertas realizdas
						if (mysqli_num_rows($result)==0) {
							echo "<h3 class='text-danger'>No ha realizado ninguna oferta</h3>";
						}
						
						while ($row=mysqli_fetch_array($result) ) {
							echo "<div class='well well-sm row'>
  									<div class='col-md-10'>
    									<h4 class='text-left text-danger'>Raz&oacute;n</h4>
    									<p>".$row["razon"]."</p>
    									<h4 class='text-left text-danger'>Monto</h4>
    									<p>$".$row["monto"]."</p>
    								</div>;
    								<div class='col-md-2'>
    									<div class='row'>
    										<a class='btn btn-danger' href='verSubasta.php?idSubasta=".$row["idSubasta"]."'>Ver Producto</a>
    									</div>";
    								if ($row["estado"]=='activa') {	
    									echo "
    									<br />
    									<div class='row'>
    										<a class='btn btn-danger' href='verOfertaCancelar.php?idOferta=".$row["idOferta"]."'>Cancelar Oferta</a>
    									</div>
    									<br />
    									<div class='row'>
    										<a class='btn btn-danger' href='editarOferta.php?idOferta=".$row["idOferta"]."'>Editar Oferta</a>
    									</div>";
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
							<li><a href="#">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>