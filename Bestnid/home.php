<?php include("session.php"); ?>
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
		        	<span>Ordenar por:</span>
		        	<br />
		        	<ul class="list-inline">
						<li>
							<div class="dropdown">
							  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownEstado" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    Fecha de finalizaci&oacute;n
								    <span class="caret"></span>
							  	</button>
								 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								  	<li><a href="home.php?order=fecha_cierre ASC">Ascendente</a></li>
								  	<li><a href="home.php?order=fecha_cierre DESC">Descendente</a></li>   
								 </ul>
							</div>
						</li>
						<li>
							<div class="dropdown">
							  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownEstado" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    Nombre
								    <span class="caret"></span>
							  	</button>
								 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								  	<li><a href="home.php?order=nombre ASC">Ascendente</a></li>
								  	<li><a href="home.php?order=nombre DESC">Descendente</a></li>   
								 </ul>
							</div>
						</li>
						<li>
							<div class="dropdown">
							  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownEstado" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    Fecha de realizaci&oacute;n
								    <span class="caret"></span>
							  	</button>
								 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								  	<li><a href="home.php?order=fecha_realizacion ASC">Ascendente</a></li>
								  	<li><a href="home.php?order=fecha_realizacion DESC">Descendente</a></li>   
								 </ul>
							</div>
						</li>
					</ul>
		        	<?php			          
						include("conexion.php");
						

						//cerrar automáticamente las subastas finalizadas que hayan excedido el tiempo máximo para elegir un ganador
						$tiempoLimiteQuery= mysqli_query($link,"SELECT CONVERT(valor,unsigned) as value FROM Configuracion WHERE clave='tiempoLimiteElegirGanador'");
						$tiempoLimiteElegirGanador= mysqli_fetch_array($tiempoLimiteQuery);

						$actualizarSubastas = mysqli_query($link, "UPDATE Subasta SET estado='cerrada' WHERE (current_date()> date_add(fecha_cierre,INTERVAL ".$tiempoLimiteElegirGanador["value"]." DAY)) and estado='finalizada' ") or die (mysqli_error($link));

						//finalizar aquellas subastas para las que se alcanzo su fecha de fin
						$result= mysqli_query ($link,"UPDATE Subasta SET estado='finalizada' WHERE estado='activa' and fecha_cierre<=current_date()");
						
						//cancelar subastas que finalizaron sin ofertas
						$result= mysqli_query ($link,"UPDATE Subasta SET estado ='cerrada' WHERE estado='finalizada' and NOT EXISTS (SELECT * FROM Oferta WHERE Oferta.idSubasta=Subasta.idSubasta)");


						//sino se pasa un criterio de ordenación no se ordenan las subastas
						if (!isset($_GET["order"]) || ($_GET["order"]!="estado ASC" && $_GET["order"]!="estado DESC" && $_GET["order"]!="fecha_cierre ASC" && $_GET["order"]!="fecha_cierre DESC" && $_GET["order"]!="nombre ASC" && $_GET["order"]!="nombre DESC" && $_GET["order"]!="fecha_realizacion ASC" && $_GET["order"]!="fecha_realizacion DESC") ) {
							$result = mysqli_query ($link, "SELECT Subasta.idSubasta,Subasta.fecha_cierre,Subasta.estado,Subasta.fecha_realizacion,Subasta.idUsuario, Producto.imagen, Producto.nombre, Producto.descripcion, Categoria.nombre AS nomCat 
								FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto 
								INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria WHERE Subasta.estado='activa' ORDER BY Subasta.fecha_realizacion DESC") or die (mysqli_error($link));
						}
						else {
							$result = mysqli_query ($link, "SELECT Subasta.idSubasta,Subasta.fecha_cierre,Subasta.estado,Subasta.fecha_realizacion,Subasta.idUsuario, Producto.imagen, Producto.nombre, Producto.descripcion, Categoria.nombre AS nomCat 
								FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto 
								INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria WHERE Subasta.estado='activa' ORDER BY ".$_GET["order"]." ") or die (mysqli_error($link));
						}

						while ($row=mysqli_fetch_array($result) ) {
							$resultOf=mysqli_query ($link, "SELECT * FROM Oferta WHERE idSubasta='".$row["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
							$numRows = mysqli_num_rows ($resultOf);
							$ofertaDeUsuario=mysqli_fetch_array($resultOf);
							
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
    											<h5><strong>Realizada: </strong>".date('d-m-Y',strtotime($row["fecha_realizacion"]))."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Finaliza: </strong>".date('d-m-Y',strtotime($row["fecha_cierre"]))."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Categoría: </strong>".$row["nomCat"]."</h5>
    										</div>
    									</div>
    									<div class='col-md-5'>
    										<p>".$row["descripcion"]."</p>
    									</div>
    									<div class='col-md-2'>
    										<div class='row'>
    										<a class='btn btn-danger' href='verSubasta.php?idSubasta=".$row["idSubasta"]."'>Ver Producto</a>
    										</div>
    									";
    								if ($row["estado"]=="activa" && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows==0 ) {
    									echo "
    										<div class='row'>
    										<a class='btn btn-danger' href='altaOferta.php?idSubasta=".$row["idSubasta"]."'>Ofertar</a>
    										</div>
    										 ";
    								} elseif ($row["estado"]=="activa" && $row["idUsuario"]!=$_SESSION["idUsuario"] && $numRows>0) {
    									echo "
    										 <div class='row'>
    										 	<a class='btn btn-danger' href='editarOferta.php?idOferta=".$ofertaDeUsuario["idOferta"]."'>Editar Oferta</a>
    										 </div>
    										 <div class='row'>
    										 	<a class='btn btn-danger' href='verOfertaCancelar.php?idOferta=".$ofertaDeUsuario["idOferta"]."'>Cancelar Oferta</a>
    										 </div>
    										 ";
    								} elseif ($row["estado"]=="finalizada" && $row["idUsuario"]==$_SESSION["idUsuario"]) {
    									echo "
    										 <div class='row'>
    										 <a class='btn btn-danger' href='elegirGanador.php?idSubasta=".$row["idSubasta"]."'>Elegir Ganador</a>
    									     </div>
    									     ";
    								}
    								if ($row["estado"]=="activa" && $row["idUsuario"]==$_SESSION["idUsuario"]) {
    									echo "
    										 <div class='row'>
    										 <a class='btn btn-danger' href='editarSubasta.php?idSubasta=".$row["idSubasta"]."'>Editar Subasta</a>
    									     </div>
    									     ";
    								}
    								if ($row["estado"]!="cerrada" && ($row["idUsuario"]==$_SESSION["idUsuario"] || $_SESSION["admin"])) {
    									echo "
    										 <div class='row'>
    										 <a class='btn btn-danger' href='cancelarSubasta.php?idSubasta=".$row["idSubasta"]."'>Cancelar Subasta</a>
    									     </div>
    									     ";
    								}
    								echo "
  								  		</div>
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