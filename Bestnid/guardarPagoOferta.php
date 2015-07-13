<?php
	include("session.php"); 
	//chequear que la oferta sea una oferta ganadora de una subasta, que el usuario logueado sea el ofertante y que no haya sido pagada todavia
	include("conexion.php");
	$existeOfertaGanadora = mysqli_query ($link, "SELECT * FROM Venta INNER JOIN Oferta ON Venta.idOferta=Oferta.idOferta 
		WHERE Venta.idOferta='".$_POST["idOferta"]."' and Venta.ofertaPagada = 0 and Oferta.idUsuario='".$_SESSION["idUsuario"]."' ");

	if (mysqli_num_rows($existeOfertaGanadora)==0 || !isset($_POST["idOferta"])) {
		header ("Location: home.php");
	}
	else {
		$actualizarVenta= mysqli_query ($link, "UPDATE Venta SET ofertaPagada=1 WHERE idOferta='".$_POST["idOferta"]."' ");
	}

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
		<link rel="stylesheet" href="Bootstrap/css/jquery-ui.css" />

		
		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
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
				<div class="col-md-10">
					<div class="row text-center">
						<h3>EL PAGO FUE REALIZADO EXIT&Oacute;SAMENTE</h3>
						<br />
					</div>
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							<?php 
								$datosOferta = mysqli_fetch_array($existeOfertaGanadora);
							?>
							<div class="panel panel-default">
								<div class="panel-body">
							    	<p class="lead"><?php echo $datosOferta["razon"]; ?></p>
							  	</div>	
							</div>
							<p class="text-danger lead">MONTO PAGADO: <strong>$<?php echo $datosOferta["monto"]; ?></strong></p>
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