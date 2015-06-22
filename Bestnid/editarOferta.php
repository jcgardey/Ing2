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

		
		<script src="Bootstrap/js/jquery-1.11.3.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/jquery-ui.js"></script>
		<script src="Bootstrap/js/validarOferta.js"></script>
		<script src="Bootstrap/js/jquery.mask.js"></script>
		<script>
			
			function validarFormEditarOFerta () {
				if (validarMonto()) {
					document.getElementById("f_editarOferta").submit();
				}
			}

			window.onload = function () {
				document.getElementById("btn_editarOferta").onclick = validarFormEditarOFerta;
			}
		</script>
	</head>
	<body>
		<?php 
			 
			include ("conexion.php");
			$existeOferta = mysqli_query($link,"SELECT * FROM Oferta WHERE idUsuario='".$_SESSION["idUsuario"]."' and idOferta='".$_GET["idOferta"]."' ")
			or die (mysqli_error($link));
			if (!isset($_GET["idOferta"]) || mysqli_num_rows($existeOferta)==0) {
				header ("Location: home.php"); 
			}
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
					<div class="col-md-3">
						<h2>Editar Oferta</h2>
					</div>
					<div class="col-md-7">
						<form name="frm-editarOferta" id="f_editarOferta" method="post" action="verOfertaEditar.php">		
							<div class="form-group">
								<label for="inputMonto">Monto (valor en $)<span class="text-danger">*</span></label>
								<input class="form-control" name="monto" id="inputMonto" placeholder="únicamente números">
								<div id="campoMonto">
								</div>
							</div>
							<input type="hidden" name="idOferta" value=<?php echo $_GET["idOferta"]; ?> />
							<button type="button" id="btn_editarOferta" class="btn btn-danger">Editar</button>
						</form>
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