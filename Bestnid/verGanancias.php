<?php 
	include ("sessionAdmin.php"); 
	include("conexion.php");
	if (!isset($_POST["fechaDesde"]) && !isset($_POST["fechaHasta"])) {
		$ventas = mysqli_query ($link, "SELECT Venta.porcentaje,Venta.fecha, Oferta.monto, Subasta.idSubasta,Usuario.nombre_usuario, Usuario.nombre AS nombrePilaUsuario, Usuario.apellido, Venta.porcentaje, Producto.nombre
			FROM Venta INNER JOIN Oferta ON Venta.idOferta=Oferta.idOferta 
			INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta 
			INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto
			INNER JOIN Usuario ON Subasta.idUsuario=Usuario.idUsuario");
			$totalGanado = mysqli_query($link, "SELECT sum(venta.porcentaje * oferta.monto/100) AS totalGanado FROM Venta INNER JOIN Oferta ON Oferta.idOferta=Venta.idOferta ");
	}
	else {
		$ventas = mysqli_query ($link, "SELECT Venta.porcentaje, Venta.fecha, Oferta.monto,Subasta.idSubasta,Usuario.nombre_usuario, Usuario.nombre AS nombrePilaUsuario, Usuario.apellido, Venta.porcentaje, Producto.nombre
			FROM Venta INNER JOIN Oferta ON Venta.idOferta=Oferta.idOferta 
			INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta 
			INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto
			INNER JOIN Usuario ON Subasta.idUsuario=Usuario.idUsuario 
			WHERE Venta.fecha>=STR_TO_DATE('".$_POST["fechaDesde"]."','%d/%m/%Y') and 
			Venta.fecha<= STR_TO_DATE('".$_POST["fechaHasta"]."','%d/%m/%Y')  ");

			$totalGanado = mysqli_query($link, "SELECT sum(venta.porcentaje * oferta.monto/100) AS totalGanado FROM Venta INNER JOIN Oferta ON Oferta.idOferta=Venta.idOferta
			WHERE Venta.fecha>=STR_TO_DATE('".$_POST["fechaDesde"]."','%d/%m/%Y') and Venta.fecha<= STR_TO_DATE('".$_POST["fechaHasta"]."','%d/%m/%Y')  ");
	}
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
		<script src="Bootstrap/js/validarRegistro.js"></script>
		<script>
			 $.datepicker.regional['es'] = {
			 closeText: 'Cerrar',
			 prevText: '<Ant',
			 nextText: 'Sig>',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			 weekHeader: 'Sm',
			 dateFormat: 'dd/mm/yy',
			 firstDay: 1,
			 isRTL: false,
			 showMonthAfterYear: false,
			 yearSuffix: ''
			 };
			 $.datepicker.setDefaults($.datepicker.regional['es']);
	
					
			$(function () {
				$("#f_desde").datepicker();
			});
			$(function () {
				$("#f_hasta").datepicker();
			});
		</script>
		<script>
			function validarFormularioFechas () {
				if (validarCampoObligatorio("f_desde", "campoFecha") && validarCampoObligatorio("f_hasta", "campoFecha") ) {
					document.getElementById("formularioFechasDeVentas").submit();
				}
			}

			window.onload = function () {
				document.getElementById("b_aceptar").onclick = validarFormularioFechas;
			}
		</script>
	
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
		        <div class="col-md-9">
					<form class="form-inline" id="formularioFechasDeVentas" action="verGanancias.php" method="POST">
								<div class="form-group">
									<label for="f_desde">Desde</label>
									<input name="fechaDesde" type="text" class="form-control" readonly="readonly" id="f_desde" placeholder="">
								</div>
								<div class="form-group">
									<label for="f_hasta">Hasta</label>
									<input name="fechaHasta" type="text" class="form-control" readonly="readonly" id="f_hasta" placeholder="">
								</div>
								<button type="button" id="b_aceptar" class="btn btn-default">Aceptar</button>
					</form>
					<div id="campoFecha">
					</div>
					<div class="row">
						<h3 class="text-center">Ganancias</h3>
					</div>
					<div class="row">
						<br />
						<h4 class="text-danger"><strong>TOTAL GANADO: $<?php echo mysqli_fetch_array($totalGanado)["totalGanado"];?></strong></h4>
					</div>
					<div class="row">
						<table class="table table-bordered">
							<tr>
								<td><strong>Fecha</strong></td>
								<td><strong>Usuario</strong></td>
								<td><strong>Apellido</strong></td>
								<td><strong>Nombre</strong></td>
								<td><strong>Producto</strong></td>
								<td><strong>Comisi&oacute;n</strong></td>
								<td><strong>Monto ganado</strong></td>
							</tr>
							<?php
								while ($row=mysqli_fetch_array($ventas)) {
								$montoGanado=($row["porcentaje"] * $row["monto"])/100;
								echo "
								<tr>
									<td>".date('d-m-Y',strtotime($row["fecha"]))."</td>
									<td>".$row["nombre_usuario"]."</td>
									<td>".$row["apellido"]."</td>
									<td>".$row["nombrePilaUsuario"]."</td>
									<td>".$row["nombre"]."</td>
									<td>".$row["porcentaje"]."%</td>
									<td>$".$montoGanado."</td>
									
								</tr> ";
								}
							?>
						</table>
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