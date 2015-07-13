<?php 
	include("session.php"); 
	//chequear que la subasta tenga una oferta ganadora, que el usuario logueado sea el subastador y que la comision no haya sido pagada todavia
	include("conexion.php");
	$productoDeLaSubasta = mysqli_query ($link, "SELECT * FROM Venta INNER JOIN Oferta ON Venta.idOferta=Oferta.idOferta INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto
		WHERE Venta.idOferta='".$_GET["idOferta"]."' and Venta.comisionPagada = 0 and Subasta.idUsuario='".$_SESSION["idUsuario"]."' ");

	if (mysqli_num_rows($productoDeLaSubasta)==0 || !isset($_GET["idOferta"])) {
		header ("Location: home.php");
	}
	else { 
		$datosProducto = mysqli_fetch_array($productoDeLaSubasta);					
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
		
		<script src="Bootstrap/js/jquery.maskedinput.js"></script>
		<script>
			$.mask.definitions['A'] ="[A-Za-z ]";
			jQuery(function($){
		       $("#inputNumeroTarjeta").mask("9999-9999-9999-9999", {placeholder:" "});
		       $("#inputCodigoSeguridad").mask("999", {placeholder:" "});
			});

			window.onload = function () {
				document.getElementById("btn_pagoComision").onclick = validarPago;
			}

			function validarCampo (id, idCampoError) {
				if (!$("#" + id).val()) {
					$("#" + idCampoError).html("<p class='text-danger'>Complete este campo</p>");
					$("#" + id).focus();
					return false;
				}
				return true;
			}
			
			function validarPago () {
				if (validarCampo ("inputTitular", "campoTitular") && validarCampo ("inputNumeroTarjeta", "campoNumeroTarjeta") &&
					validarCampo ("inputCodigoSeguridad", "campoCodigoSeguridad") ) {
						document.getElementById("f_pagoComision").submit();
				}
			}			
		</script>
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
					<div class="row">
						<div class="col-md-4">
							<a href='<?php echo $datosProducto["imagen"]; ?>' target="_blank"><img src='<?php echo $datosProducto["imagen"]; ?>' class="img-responsive" alt="descripcion" /></a> 
						</div>
						<div class="col-md-6 col-md-offset-1">
							<br />
							<div class="row">
								<h4><strong>Nombre del producto: </strong></h4>
								<?php echo "<p class='lead'>".$datosProducto["nombre"]."</p>"; ?>
							</div>
							<div class="row">	
								<h4><strong>Descripci&oacute;n: </strong></h4>
								<?php echo "<p class='lead'>".$datosProducto["descripcion"]."</p>"; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<br />
						<h4 class="text-center"><strong>DATOS DE LA OFERTA GANADORA</strong></h4>
						<div class="col-md-9 col-md-offset-1">
							<div class="panel panel-default">
								<div class="panel-body">
									<p class="lead"><?php echo $datosProducto["razon"]; ?></p>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6">
											<p class="text-danger">MONTO DE LA OFERTA <strong>$<?php echo $datosProducto["monto"]; ?></strong></p>
										</div>
										<div class="col-md-2 col-md-offset-4">
											<p class="text-danger">COMISI&Oacute;N: <strong><?php echo $datosProducto["porcentaje"]; ?>%</strong></p>
										</div>
									</div>
								</div>
							</div>
							<p class="lead">MONTO A PAGAR: $<?php echo ($datosProducto["monto"] * $datosProducto["porcentaje"] ) / 100 ; ?> </p>
						</div>
					</div>
					<div class="row">

					</div>
					<div class="row">
						<div class="col-md-7 col-md-offset-2">
							<form name="frm-pagoComision" id="f_pagoComision" method="post" action="guardarPagoComision.php">		
								<div class="form-group">
									<label for="inputTitular">Titular de la tarjeta de cr&eacute;dito<span class="text-danger">*</span></label>
									<input class="form-control" name="titular" id="inputTitular">
									<div id="campoTitular">
									</div>
								</div>
								<div class="form-group">
									<label for="inputNumeroTarjeta">N&uacute;mero de tarjeta<span class="text-danger">*</span></label>
									<input class="form-control" name="numeroTarjeta" id="inputNumeroTarjeta">
									<div id="campoNumeroTarjeta">
									</div>
								</div>
								<div class="form-group">
									<label for="inputNumeroTarjeta">C&oacute;digo de seguridad<span class="text-danger">*</span></label>
									<input class="form-control" type="password" name="codigoSeguridad" id="inputCodigoSeguridad">
									<div id="campoCodigoSeguridad">
									</div>
								</div>
								<input type="hidden" name="idOferta" value=<?php echo $_GET["idOferta"]; ?> />
								<button type="button" id="btn_pagoComision" class="btn btn-danger">Pagar</button>
							</form>
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
							<li><a href="#">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>