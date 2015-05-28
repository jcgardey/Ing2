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

		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
		<script src="Bootstrap/js/validarCategoria.js"></script>
	</head>
	<script>
		window.onload = function () {
			document.getElementById("b_ingresar").onclick = validarInsercionCategoria;
		}
	</script>
	<body>
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				 	<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" rel="home" href="home.php" title="Logotipo">
	        				<img style="max-height:100%;,max-width:100%;" src="logo.png" />
	    				</a>
					</div>
					<ul class="nav navbar-nav navbar-left">	
							<li>
								<a class="navbar-brand" href="home.php">Bestnid</a>
							</li>			
					</ul>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Buscar producto">
							</div>
							<button type="submit" class="btn btn-default">Buscar</button>
						</form>
						<ul class="nav navbar-nav navbar-right">	
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION["usuario"]?><span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="salir.php">Salir</a></li>
									<li><a href="#">Configuracion</a></li>
								</ul>
							<li>
								<a class="navbar-brand" href="registrarse.php">Ayuda</a>
							</li>	
						</ul>
					</div>
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		<section class="main container-fluid">
			<div class="row">	
				<aside class="col-sm-3 col-md-2 sidebar">
		        	<ul class="nav nav-sidebar"> 	
			            <?php			          
							include("conexion.php");
							$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
							while ($row=mysqli_fetch_array($result) ) {
								echo "<li><a class='text-danger'href=#>".$row["nombre"]."</a></li>";
							}
						?>
			        </ul>
		        </aside>
		        <div class="col-md-3">
		        	<h2>Ingresar una categoria</h2>
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
		<footer>
			<div class="container">
				<div class="col-md-8 col-md-offset-3">
					<h2>Sistema de Subastas Bestnid</h2>
				</div>
			</div>
		</footer>
	</body>
</html>