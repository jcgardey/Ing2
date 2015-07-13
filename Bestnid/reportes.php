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
		<?php 
			include ("navbarAdmin.html"); 
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
		        	include ("conexion.php");
		        	$subastasReportadas =  mysqli_query ($link, "SELECT Subasta.idSubasta,Subasta.fecha_cierre,Subasta.estado,Subasta.idUsuario,Subasta.fecha_realizacion, Producto.imagen, Producto.nombre, Producto.descripcion, Categoria.nombre AS nomCat 
								FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto 
								INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria 
								WHERE Subasta.reportada=1 ");

					if (mysqli_num_rows($subastasReportadas)==0) { ?>
						<h3><strong>No hay subastas reportadas</strong></h3>
			  <?php }
			  		else { ?>
			  			<h3><strong>Subastas reportadas</strong></h3>
			  			<?php
			  			while ($tuplaSubasta=mysqli_fetch_array($subastasReportadas)) { ?>
			  				<div class='panel panel-default row'>
  								<div class='panel-body container-fluid'>
  									<div class='col-md-2'>
    									<img src='<?php echo $tuplaSubasta["imagen"]; ?>' class='img-responsive' alt='imagen' />
    								</div>
    								<div class='col-md-3'>
    									<div class='row'>
    										<h3><?php echo $tuplaSubasta["nombre"]; ?></h3>
    									</div>
    									<div class='row'>
    										<h5><strong>Realizada: </strong><?php echo date('d-m-Y',strtotime($tuplaSubasta["fecha_realizacion"])); ?></h5>
    									</div>
    									<div class='row'>
    										<h5><strong>Finaliza: </strong><?php echo date('d-m-Y',strtotime($tuplaSubasta["fecha_cierre"])); ?></h5>
    									</div>
    									<div class='row'>
    										<h5><strong>Categoría: </strong><?php echo $tuplaSubasta["nomCat"]; ?></h5>
    									</div>
    								</div>
    								<div class='col-md-5'>
    									<p><?php $tuplaSubasta["descripcion"] ?></p>
    								</div>
    								<div class='col-md-2'>
    									<div class='row'>
    										<a class='btn btn-danger' href='<?php echo "verSubasta.php?idSubasta=".$tuplaSubasta["idSubasta"].""; ?>'>Ver Producto</a>
    									</div>
    									<div class="row">
    										<a class='btn btn-danger' onclick="eliminarSubasta()">Eliminar Subasta</a>
    										<script>
												function eliminarSubasta() {
													if (confirm("¿Está seguro que desea eliminar la subasta reportada?")) {
														window.location='<?php echo "eliminarSubasta.php?idSubasta=".$tuplaSubasta["idSubasta"].""; ?>';
													}
												}
											</script>
    									</div>
    									<div class="row">
    										<!--Si el usuario subastador es administrador, no puede ser desactivado -->
    										<?php if ($tuplaSubasta["idUsuario"]!=$_SESSION["idUsuario"]) { ?>
    											<a class='btn btn-danger' onclick="inactivarSubastador()">Inactivar Subastador</a>
    										<?php } ?>
    										<script>
												function inactivarSubastador() {
													if (confirm("¿Está seguro que desea inactivar al usuario dueño de la subasta?")) {
														window.location='<?php echo "inactivarUsuario.php?idUsuario=".$tuplaSubasta["idUsuario"].""; ?>';
													}
												}
											</script>
    									</div>
    									<div class="row">
    										<script>
												function ignorarReporteSubasta() {
													if (confirm("¿Está seguro que desea cancelar el reporte de la subasta?")) {
														window.location='<?php echo "cancelarReporteSubasta.php?idSubasta=".$tuplaSubasta["idSubasta"].""; ?>';
													}
												}
											</script>
    										<a class='btn btn-danger' onclick="ignorarReporteSubasta()">Cancelar Reporte</a>
    									</div>
    								</div>
    							</div>
    						</div>
			  	 <?php } 
			  		}
			  		$ofertasReportadas = mysqli_query($link, "SELECT Oferta.monto,Oferta.idSubasta, Oferta.razon, Oferta.idUsuario, Oferta.idOferta, Usuario.nombre_usuario FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario
			  			WHERE Oferta.reportada=1 ") or die (mysqli_error($link));

			  		if (mysqli_num_rows($ofertasReportadas)==0) { ?>
						<h3><strong>No hay ofertas reportadas</strong></h3>
					<?php } 
					else { ?>
						<h3><strong>Ofertas reportadas</strong></h3>
					<?php 
						while ($tuplaOferta = mysqli_fetch_array($ofertasReportadas)) { ?>
							<div class='panel panel-default row'>
		  						<div class='panel-body container-fluid'>
		  							<div class='row'>
		  								<div class='col-md-10'>
		  									<a class='lead' href='<?php echo "verPerfilDeUsuario.php?idUsuario=".$_SESSION["idUsuario"]."";?>'> <?php echo $tuplaOferta["nombre_usuario"];?></a>
		  									<p class='lead'><?php echo $tuplaOferta["razon"]; ?></p>	
		  								</div>
		  								<div class="col-md-2">	
		  									<div class="row">
		  										<a class='btn btn-danger' href='<?php echo "verSubasta.php?idSubasta=".$tuplaOferta["idSubasta"].""; ?>' >Ver Producto</a>
		  									</div>
		  									<div class="row">
		  										<script>
		  											function cancelarReporteOferta () {
		  												if (confirm("¿Está seguro que desea cancelar el reporte?")) {
		  													window.location='<?php echo "cancelarReporteOferta.php?idOferta=".$tuplaOferta["idOferta"].""; ?>';
		  												}
		  											}
		  										</script>
		  										<a class='btn btn-danger' onclick="cancelarReporteOferta()">Cancelar Reporte</a>
		  									</div>
		  									<div class="row">
		  										<script>
		  											function eliminarOferta () {
		  												if (confirm("¿Está seguro que desea eliminar la oferta reportada?")) {
		  													window.location='<?php echo "eliminarOfertaReportada.php?idOferta=".$tuplaOferta["idOferta"].""; ?>';
		  												}
		  											}
		  										</script>
		  										<a class='btn btn-danger' onclick="eliminarOferta()">Eliminar Oferta</a>
		  									</div>
		  									<div class="row">
		  										<script>
		  											function inactivarOfertante () {
		  												if (confirm("¿Está seguro que desea inactivar al usuario dueño de la oferta?")) {
		  													window.location='<?php echo "inactivarUsuario.php?idUsuario=".$tuplaOferta["idUsuario"].""; ?>';
		  												}
		  											}
		  										</script>
		  										<a class='btn btn-danger' onclick="inactivarOfertante()">Inactivar Ofertante</a>
		  									</div>
		  								</div>
		  							</div>
		  						</div>
						 	</div>
				<?php   }
					} ?>     
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