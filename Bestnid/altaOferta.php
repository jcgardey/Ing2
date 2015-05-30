<?php include("session.php"); ?>
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

		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarOferta.js"></script>
		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
		<script src="Bootstrap/js/fechaEspañol.js"></script>
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
		<section class="main container">
			<div class="row">
				<div class="col-md-3">
					<h2>Realiza una Oferta</h2>
				</div>
				<div class="col-md-9">
					<form name="frm-oferta" id="f_oferta" method="post" action="verOferta.php">		
						<div class="form-group">
							<label for="inputRazon">Raz&oacute;n por la cual se solicita el producto<span class="text-danger">*</span></label>
							<textarea class="form-control" rows="5" name="razon" id="inputRazon"></textarea>
							<div id="campoRazon">
							</div>
						</div>
						<div class="form-group">
							<label for="inputMonto">Monto<span class="text-danger">*</span></label>
							<input class="form-control" name="monto" id="inputMonto" placeholder="únicamente números">
							<div id="campoMonto">
							</div>
						</div>
						<input type="hidden" name="idSubasta" value=<?php echo $_GET["idSubasta"]; ?> />
						<button type="button" id="btn_oferta" class="btn btn-danger">Ofertar</button>
					</form>
				</div>
			</div>
		</section>
		<footer>
			<div class="container">
				<div class="col-md-8 col-md-offset-3">
					<h2>Sistema de Subastas Bestnid</h2>
				</div>
			</div>
		</footer>
	</body>
</html>