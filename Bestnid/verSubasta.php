<?php session_start(); ?>
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
			if (!isset($_GET["idSubasta"]) ) {
				header("Location: home.php");
			}
			
			if (isset($_SESSION["admin"]) && $_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			elseif (isset($_SESSION["admin"]) && $_SESSION["admin"]==false) {
				include ("navbar.html"); 
			} else {
				include ("navbarIndex.html");
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
						<?php
							include ("conexion.php");
							$result = mysqli_query ($link, "SELECT Subasta.idUsuario, Subasta.fecha_cierre, Producto.imagen, Subasta.estado, Producto.descripcion, Producto.nombre, Categoria.nombre AS nomCat, Usuario.nombre_usuario 
							 	FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto INNER JOIN Categoria ON Categoria.idCategoria=Producto.idCategoria INNER JOIN Usuario ON Subasta.idUsuario=Usuario.idUsuario 
								WHERE idSubasta='".$_GET["idSubasta"]."' ");

							//en caso de que la subasta no exista..
							if (mysqli_num_rows($result)==0) {
								header("Location: home.php");
							}
					
							$row=mysqli_fetch_array($result);

							//cambiar estado de la subasta en caso que se haya alcanzado su fecha de cierre
							$result2=mysqli_query ($link, "UPDATE Subasta SET estado='finalizada' WHERE estado='activa' and idSubasta='".$_GET["idSubasta"]."' and fecha_cierre <= current_date()  ");

							//evaluar en caso de que haya un usuario logueado, si ya hizo una oferta en esta subasta
							if (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"]==true) {
								$resultOf=mysqli_query ($link, "SELECT * FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
								$numRows = mysqli_num_rows ($resultOf);
							}
						?>
			
						<div class="row">
							<img src='<?php echo $row["imagen"]; ?>' class="img-responsive" alt="imagen">
						</div>
						<br />
						<div class="row">
						<?php
							if ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows==0) {
								echo "<a class='btn btn-danger' href='altaOferta.php?idSubasta=".$_GET["idSubasta"]." '>Ofertar</a> ";
							} elseif ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows>0) {
								echo "<a class='btn btn-danger' href='#'>Editar Oferta</a> ";
							} elseif ($row["estado"]=='finalizada' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"]) {
								echo "<a class='btn btn-danger' href='elegirGanador.php?idSubasta=".$_GET["idSubasta"]." '>Elegir Ganador</a> ";
							}
						?>	
						</div>
						<div class="row">
							<h4><strong>Vendedor: </strong></h4>
							<?php echo "<a class='lead' href=#>".$row["nombre_usuario"]."</a>"; ?>
						</div>
						<div class="row">
							<h4><strong>Nombre del producto: </strong></h4>
							<?php echo "<p class='lead'>".$row["nombre"]."</p>"; ?>
						</div>
						<div class="row">	
							<h4><strong>Descripci&oacute;n: </strong></h4>
							<?php echo "<p class='lead'>".$row["descripcion"]."</p>"; ?>
						</div>
						<div class="row">	
							<h4><strong>Categor&iacute;a: </strong></h4>
							<?php echo "<p class='lead'>".$row["nomCat"]."</p>"; ?>
						</div>
						<div class="row">
							<h4><strong>Finaliza: </strong></h4>
							<?php echo "<p class='lead'>".date('d-m-Y',strtotime($row["fecha_cierre"]))."</p>"; ?>
						</div>
						<div class="row">
							<h4><strong>Estado: </strong></h4>
							<?php echo "<p class='lead'>".$row["estado"]."</p>"; ?>
						</div>
					</div>
					<div class="row">
						<?php
							include ("conexion.php");
							
							//chequear si la subasta tiene una oferta ganadora
							if ($row["estado"]=='cerrada') {
								$result=mysqli_query ($link, "SELECT * FROM Oferta INNER JOIN Venta ON Oferta.idOferta=Venta.idOferta INNER JOIN Usuario ON Usuario.idUsuario=Oferta.idUsuario
									WHERE Oferta.idSubasta='".$_GET["idSubasta"]."' ");
								
								if (mysqli_num_rows($result) != 0) {
									$rowGan = mysqli_fetch_array($result);
									echo "<h3 class='text-danger'><strong>Oferta Ganadora</strong></h3>";
									echo "<div class='panel panel-default row'>
	  									<div class='panel-body container-fluid'>
	  										<div class='row'>
	  											<div class='col-md-10'>
	  												<a class='lead' href=#>".$rowGan["nombre_usuario"]."</a>
	  											</div>
	  										</div>
	  										<div class='row'>
	  											<div class='col-md-10'>
	  												<p class='lead'>".$rowGan["razon"]."</p>
	  											</div>";
	  										if (isset($_SESSION["idUsuario"]) && $_SESSION["idUsuario"]==$row["idUsuario"] ) {
	  											echo "
	  											<div class='col-md-2'>
	  												<a class='btn btn-danger' href='visualizarGanador.php?idOferta=".$rowGan["idOferta"]."'>Ver Ganador</a>
	  											</div>";
	  										}
	  										echo "
	  										</div>
	  								  	</div>
									  </div>";
								} else {
									echo "<h3 class='text-danger'><strong>Esta subasta finaliz&oacute; sin ofertas</strong></h3>";
								}
							}

							//se muestran las ofertas realizadas solo si el usuario logueado es el subastador o si no se pueden realizar mas ofertas en ella
							if ( (isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"]) || $row["estado"]!='activa') {
								//chequear si la subasta tiene alguna oferta
								$result=mysqli_query($link,"SELECT * FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."' ");
								if (mysqli_num_rows($result)>0) {
									echo "<h3><strong>Ofertas realizadas</strong></h3>";
								}
								else {
									echo "<h3><strong>No hay ofertas realizadas</strong></h3>";
								}
								
								$result= mysqli_query ($link, "SELECT * FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario 
									WHERE Oferta.idSubasta='".$_GET["idSubasta"]."' ");
								while ($row=mysqli_fetch_array($result) ) {
									echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href=#>".$row["nombre_usuario"]."</a>
		  											</div>
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$row["razon"]."</p>
		  											</div>
		  										</div>
		  								  	</div>
										  </div>";
								}
							}
						?>
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
							<li><a href="#">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>