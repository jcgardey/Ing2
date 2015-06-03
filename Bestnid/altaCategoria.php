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

		<link rel="stylesheet" href="Bootstrap/css/jquery-ui.css" />

		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>

		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarCategoria.js"></script>
	</head>
	<script>
		window.onload = function () {
			document.getElementById("b_ingresar").onclick = validarInsercionCategoria;
		}
	</script>
	<body>
		<?php 
			include ("navbarAdmin.html"); 
		?>
		<section class="main container-fluid">
			<div class="row">	
				<aside class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger' href='listadoProductosPorCategoria.php?nombre=".$row["nombre"]." '>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </aside>
		        <div class="col-md-3">
		        	<h2>Ingresar una categor&iacute;a</h2>
		        </div>
		        <div class="col-md-7">
		        	<form name="frm-altaCategoria" id="f_altaCategoria" action="insertarCategoria.php" method="POST">
						<div class="form-group">
							<label for="inputNombre">Nombre<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="nombreCategoria" id="inputNombre">
							<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="si") ) { ?>
									<p class="text-danger">Existe una categoria con ese nombre</p>
							<?php } ?>
							<div id="campoNombreCategoria">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDescripcion">Descripcion<span class="text-danger">*</span></label>
							<textarea class="form-control" name="descripcionCategoria" id="inputDescripcion" rows="5"></textarea>
							<div id="campoDescripcionCategoria">
							</div>
						</div>
						<button class="btn btn-danger" type="button" id="b_ingresar">Ingresar</button>
					</form>
		        </div>
		     </div>
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