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
		<script src="Bootstrap/js/validarRespuesta.js"></script>
		<script>
			(function($){
		       $("#inputRespuesta");
			})

		</script>

	</head>
	<body>
		<?php 
		
			include ("conexion.php");
			$result = mysqli_query($link,"SELECT * FROM Comentario WHERE idComentario ='".$_GET["idComentario"]."' ");
			$row=mysqli_fetch_array($result);
			
			//no se puede realizar una respuesta si no existe el comentario (en el if n2)
			//no se puede realizar una respuesta sin pasar el id del comentario (en el if n1)
			//no se puede realizar una respuesta si el usuario que comenta es el mismo que responde (en el if n3)
			//no se puede realizar una respuesta si ya hay una respuesta (en el if n4)
			if(!isset($_GET["idComentario"]) || mysqli_num_rows($result)==0 || $row["idUsuario"]==$_SESSION["idUsuario"] || $row["respuesta"]!="") {
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
						<h2>Realiza una Respuesta</h2>
					</div>
					<div class="col-md-7">
						<form name="frm-respuesta" id="f_respuesta" method="post" action="verRespuestaNuevo.php">		
							<div class="form-group">
								<label for="inputTexto">Respuesta que desea realizar<span class="text-danger">*</span></label>
								<textarea class="form-control" rows="5" name="respuesta" id="inputRespuesta"></textarea>
								<div id="campoRespuesta">
								</div>
							</div>
							<input type="hidden" name="idComentario" value=<?php echo $_GET["idComentario"]; ?> />
							<button type="button" id="btn_respuesta" class="btn btn-danger">Respuesta</button>
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