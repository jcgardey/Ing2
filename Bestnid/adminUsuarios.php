<?php 
	include ("sessionAdmin.php"); 
	include("conexion.php");
?>
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
		<link rel="stylesheet" href="Bootstrap/css/jquery-ui.css" />

		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
		
	
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
		        	
		        	<span>Ordenar por:</span>
		        	<ul class="list-inline">
							<li><a href="adminUsuarios.php?order=estado ASC">Estado</a></li>
							<li><a href="adminUsuarios.php?order=confirmado DESC">Confirmado</a></li>
							<li><a href="adminUsuarios.php?order=nombre_usuario ASC">Nombre</a></li>
							
					</ul>
		        	<?php			          
						include("conexion.php");
						//sino se pasa un criterio de ordenación no se ordenan los usuarios
						if (!isset($_GET["order"]) || ($_GET["order"]!="estado ASC" && $_GET["order"]!="confirmado DESC" && $_GET["order"]!="nombre_usuario ASC") ) {
							$result = mysqli_query ($link, "SELECT * FROM Usuario") or die (mysqli_error($link));
						}
						else {
							$result = mysqli_query ($link, "SELECT * FROM Usuario ORDER BY ".$_GET["order"]." ") or die (mysqli_error($link));
						}

						while ($row=mysqli_fetch_array($result) ) {
							
							
							echo "<div class='panel panel-default row'>
  									<div class='panel-body container-fluid'>
  										<div class='col-md-5'>
												<h4>".$row["nombre_usuario"]."</h4>
    									</div>
    									<div class='col-md-5'>
    										<div class='row'>
    											<h5><strong>Estado: </strong>".$row["estado"]."</h5>
    										</div>
    										<div class='row'>
    											<h5><strong>Confirmado: </strong>";if($row["confirmado"]==1){echo "S&iacute;";}else{echo "No";}echo"</h5>
    										</div>
    									</div>
    									
    									<div class='col-md-2'>
    										<div class='row'>";
											if($row["estado"]=='activo' && $row["nombre_usuario"]!='admin'){
												echo "<a class='btn btn-danger' href='inactivarUsuario.php?idUsuario=".$row["idUsuario"]."'>Inactivar</a>";
											}echo"
											</div>
											<div class='row'>";
											if($row["estado"]!='activo' && $row["nombre_usuario"]!='admin'){
												echo "<a class='btn btn-danger' href='activarUsuario.php?idUsuario=".$row["idUsuario"]."'>Activar</a>";
											}echo"						
											</div>
											<div class='row'>";
											if($row["confirmado"]==0 && $row["nombre_usuario"]!='admin'){
												echo "<a class='btn btn-danger' href='confirmarUsuario.php?idUsuario=".$row["idUsuario"]."'>Confirmar</a>";
											}echo"
											</div>
											<div class='row'>";
											if($row["confirmado"]==1 && $row["nombre_usuario"]!='admin'){
												echo "<a class='btn btn-danger' href='desconfirmarUsuario.php?idUsuario=".$row["idUsuario"]."'>Desconfirmar</a>";
											}echo"											
											</div>";
    								
    								echo "
  								  		</div>
  								  	</div>
								  </div>";
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
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>