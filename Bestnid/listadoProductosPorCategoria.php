
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
			session_start();
			if (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"]) {
				if ($_SESSION["admin"]) {
					include ("navbarAdmin.html");
				}
				else {
					include ("navbar.html");
				}
			}
			else {
				include ("navbarIndex.html");
			}
		?>
		<section class="main container-fluid">
			<aside class="row">	
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
		        <div class="col-sm-3 col-md-9">
		        	<?php			          
						include("conexion.php");
						//obtener la descripción de la categoria que se pasó por parámetro
						$result = mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='".$_GET["nombre"]."' ");
						$rowCat = mysqli_fetch_array($result);

						
						//finalizar aquellas subastas para las que se alcanzo su fecha de fin
						$result= mysqli_query ($link,"UPDATE Subasta SET estado='finalizada' WHERE estado='activa' and fecha_cierre<=current_date()");

						//cancelar subastas que finalizaron sin ofertas
						$result= mysqli_query ($link,"UPDATE Subasta SET estado ='cerrada' WHERE estado='finalizada' and NOT EXISTS (SELECT * FROM Oferta WHERE Oferta.idSubasta=Subasta.idSubasta)");


						$result = mysqli_query ($link, "SELECT Subasta.idSubasta,Subasta.fecha_cierre,Subasta.estado,Subasta.idUsuario, Producto.imagen, Producto.nombre, Producto.descripcion 
							FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto
							WHERE Producto.idCategoria='".$rowCat["idCategoria"]."' and (Subasta.estado='activa'  or Subasta.estado='finalizada') 
							ORDER BY Subasta.estado, Subasta.fecha_realizacion ");

						while ($row=mysqli_fetch_array($result) ) {
							if (isset($_SESSION["idUsuario"])) {
								$resultOf=mysqli_query ($link, "SELECT * FROM Oferta WHERE idSubasta='".$row["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
								$numRows = mysqli_num_rows ($resultOf);
							}
							echo "<div class='panel panel-default row'>
  									<div class='panel-body container-fluid'>
  										<div class='col-md-2'>
    										<img src='".$row["imagen"]."' class='img-responsive' alt='imagen' />
    									</div>
    									<div class='col-md-3'>
    										<div class='row'>
    											<h3>".$row["nombre"]."</h3>
    										</div>
    										<div class='row'>
    											<h5><strong>Finaliza: </strong>".date('d-m-Y',strtotime($row["fecha_cierre"]))."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Estado: </strong>".$row["estado"]."</h5>
    										</div>
    									</div>
    									<div class='col-md-5'>
    										<p>".$row["descripcion"]."</p>
    									</div>
    									<div class='col-md-2'>
    										<a class='btn btn-danger' href='verSubasta.php?idSubasta=".$row["idSubasta"]."'>Ver Producto</a>
    										<br />
    									";
    								if ($row["estado"]=="activa" && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows==0 ) {
    									echo "
    										<a class='btn btn-danger' href='altaOferta.php?idSubasta=".$row["idSubasta"]."'>Ofertar</a>
    										 ";
    								} elseif ($row["estado"]=="activa" && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows>0) {
    									echo "
    										 <a class='btn btn-danger' href='#'=".$row["idSubasta"]."'>Editar Oferta</a>
    										 ";
    								} elseif ($row["estado"]=="finalizada" && $row["idUsuario"]==$_SESSION["idUsuario"]) {
    									echo "
    										 <a class='btn btn-danger' href='elegirGanador.php?idSubasta=".$row["idSubasta"]."'>Elegir Ganador</a>
    									     ";
    								}
    								echo "
  								  		</div>
  								  	</div>
								  </div>";
						}
					?>
		        </div>

		     </aside>
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