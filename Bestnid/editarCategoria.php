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

		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarCategoria.js"></script>
	</head>
	<script>
		window.onload = function () {
			document.getElementById("b_editar").onclick = validarEdicionCategoria;
		}
	</script>
	<body>
		<?php include ("navbarAdmin.html"); ?>
		<section class="main container-fluid">
			<div class="row">	
				<aside class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			             <li class="active"><a class="text-danger" href="#"><strong>Categorias</strong></a></li>
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger'href=#>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </aside>
		        <div class="col-md-10">
		        	<form name="frm-editarCategoria" id="f_editarCategoria" action="sobreescribirCategoria.php" method="POST">
						<div class="form-group">
							<label for="inputNombre">Nombre<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="nombreCategoria" id="inputNombre" value=<?php echo $_GET["nombreCategoria"] ?> >
							<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="si") ) { ?>
									<p class="text-danger">Existe una categoria con ese nombre</p>
							<?php } ?>
							<div id="campoNombreCategoria">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDescripcion">Descripcion<span class="text-danger">*</span></label>
							<textarea class="form-control" name="descripcionCategoria" id="inputDescripcion" rows="5"><?php echo $_GET["descripcion"] ?></textarea>
							<div id="campoDescripcionCategoria">
							</div>
						</div>
						<input type="hidden" name="id" value=<?php echo $_GET["id"] ?>>
						<button class="btn btn-danger" type="button" id="b_editar">Editar</button>
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