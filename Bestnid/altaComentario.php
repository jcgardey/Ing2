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
		<script src="Bootstrap/js/validarComentario.js"></script>
		<script>
			(function($){
		       $("#inputTexto");
			})

		</script>

	</head>
	<body>
		<?php 
		
			include ("conexion.php");
			$result = mysqli_query($link,"SELECT * FROM Subasta WHERE idSubasta ='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
			
			$result2= mysqli_query($link,"SELECT * FROM Comentario WHERE idSubasta ='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");

			$result3= mysqli_query($link,"SELECT * FROM Subasta WHERE idSubasta ='".$_GET["idSubasta"]."' and estado='activa' ");
			
			//no se puede realizar un comentario si la subasta no existe o ya finalizo
			//no se puede realizar un comentario sin pasar el id de la subasta por parámetro 
			//no se puede realizar un comentario si el usuario que comenta es el mismo que el subastador
			//no se puede realizar un comentario si el usuario logueado ya comentó
			if (mysqli_num_rows($result)>0 || mysqli_num_rows($result2)>0 || mysqli_num_rows($result3)==0 || !isset($_GET["idSubasta"])) {
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
						<h2>Realiza un Comentario</h2>
					</div>
					<div class="col-md-7">
						<form name="frm-comentario" id="f_comentario" method="post" action="verComentarioNuevo.php">		
							<div class="form-group">
								<label for="inputTexto">Comentario que desea realizar<span class="text-danger">*</span></label>
								<textarea class="form-control" rows="5" name="texto" id="inputTexto"></textarea>
								<div id="campoTexto">
								</div>
							</div>
							<input type="hidden" name="idSubasta" value=<?php echo $_GET["idSubasta"]; ?> />
							<button type="button" id="btn_comentario" class="btn btn-danger">Comentario</button>
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
							<li><a href="Ayuda.pdf">Ayuda</a></li>
							<li><a href="acercaBestnid.php">Acerca de Bestnid</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>