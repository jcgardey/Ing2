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
		<link rel="stylesheet" href="Bootstrap/css/jquery-ui.css" />

		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
		<script src="Bootstrap/js/validarConfiguracion.js"></script>
		<script>
			

			function validarFormularioConfiguracion () {
				if (validarNumeroMayorACero("inputPorcentaje","campoPorcentajeGanado") && 
					validarNumeroMayorACero("inputDuracionMaxima","campoDuracionMaxima") &&
					validarNumeroMayorACero("inputTiempoMaximo","campoTiempoMaximo") ) {
					document.getElementById("f_configuracion").submit();
				}
			}


			window.onload = function () {
				document.getElementById("btnConfirmar").onclick = validarFormularioConfiguracion;
			}
		</script>		
	</head>
	<body>
		<?php include("navbarAdmin.html"); ?>
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
				<?php 
					include ("conexion.php");
					$parametros = mysqli_query ($link,"SELECT * FROM Configuracion");
					$row=mysqli_fetch_array($parametros);
				?>
				<div class="col-md-4 col-md-offset-2">
					<h3>Configuraci&oacute;n del sistema</h3>
					<form name="frm-configuracion" id="f_configuracion" action="actualizarConfiguracion.php" method="POST">
						<div class="form-group">
							<label for="inputNombreUsuario">Porcentaje ganado de cada subasta<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="porcentajeGanado" id="inputPorcentaje" placeholder="Sólo números" value='<?php $row=mysqli_fetch_array($parametros); echo $row["valor"]; ?>'>
							<div id="campoPorcentajeGanado">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Duraci&oacute;n m&aacute;xima de una subasta (en d&iacute;as)<span class="text-danger">*</span></label>
							<input type="text" name="duracionMaxima" class="form-control" id="inputDuracionMaxima" placeholder="Duraci&oacute;n en d&iacute;as" value='<?php $row=mysqli_fetch_array($parametros); echo $row["valor"]; ?>'>
							<div id="campoDuracionMaxima">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Tiempo m&aacute;ximo permitido para elegir el ganador de una subasta  (en d&iacute;as)<span class="text-danger">*</span></label>
							<input type="text" name="tiempoMaximo" class="form-control" id="inputTiempoMaximo" placeholder="Tiempo m&aacute;ximo en d&iacute;as" value='<?php $row=mysqli_fetch_array($parametros); echo $row["valor"]; ?>'>
							<div id="campoTiempoMaximo">
							</div>
						</div>
						<button type="button" class="btn btn-danger" id="btnConfirmar">Confirmar</button>
					</form>
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