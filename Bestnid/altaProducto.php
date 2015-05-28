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
	</head>
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
		<section class="main container">
			<div class="row">
				<div class="col-md-3">
					<h2>Agrega tu Producto</h2>
				</div>
				<div class="col-md-9">
					<form name="frm-producto" method="post" action="subirImagen.php" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nombre<span class="text-danger">*</span></label>
							<div class="form-inline">
								<?php if(isset($_GET["nombre"])){
									?> <input type="text" class="form-control" name="nombre" value="<?php echo $_GET["nombre"]; ?>" id="inputNombre"><?php
								}else{?>
									<input type="text" class="form-control" name="nombre" id="inputNombre" placeholder="Nombre">
								<?php } ?>
							</div>
							<div id="campoNombre">
							</div>
						</div>
						<?php
							if ( (isset($_GET["error"]) ) && ($_GET["error"]=="nombre") ) { ?>
								<p class="text-warning">¡Ingresar un nombre es necesario!</p>
						<?php } ?>
								
						<div class="form-group">
							<label>Descripci&oacute;n Producto<span class="text-danger">*</span></label>
							<div class="form-inline">
								<?php if(isset($_GET["descripcion"])){
									?> <textarea class="form-control" rows="5" name="descripcion"  id="inputDesc"><?php echo $_GET["descripcion"]; ?></textarea><?php
								}else{?>
									<textarea class="form-control" rows="5" name="descripcion" placeholder="Descripcion" id="inputDesc"></textarea>
								<?php } ?>
							</div>
							<div id="campoDescripcion">
							</div>
						</div>
						<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="descripcion") ) { ?>
									<p class="text-warning">¡Ingresar una descripci&oacute;n es necesario!</p>
						<?php } ?>
						<div class="form-group">
							<label>Elegir Cateogor&iacute;a<span class="text-danger">*</span></label>
							<div class="form-group">
								<select class="form-control" name="categoria" >
									<?php
										include("conexion.php");
										$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
										while ($row=mysqli_fetch_array($result) ) {
											echo "<option value=".$row["nombre"].">".$row["nombre"]."</option>";
										}
									?>
								</select>
							</div>
							<div id="campoCategoria">
							</div>
						</div>
						
						<div class="form-group">
							<label>Elegir fecha de cierre(MM-DD-YYYY)<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input type="date" name="fecha" min=<?php echo "".date("Y-m-d")."";?> />
							</div>
							<div id="campoFecha">
							</div>
						</div>
						<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="fecha") ) { ?>
									<p class="text-warning">¡Ingresar una fecha es necesario!</p>
						<?php } ?>
						<div class="form-group">
							<label>Elegir Imagen (jpg o png)<span class="text-danger">*</span></label>
							<div class="form-inline">
								<input class='btn btn-lg btn-default' type="file" name="imagen_fls" />
							</div>
							<div id="campoImagen">
							</div>
						</div>
						<?php
								if ( (isset($_GET["error"]) ) && ($_GET["error"]=="formato") ) { ?>
									<p class="text-warning">¡Ingresar una imagen jpg o png es necesario!</p>
						<?php } ?>
						<p class="text-danger">*Campo obligatorio</p>
						<p class="text-danger">Todas las subastas finalizan a las 23:59hs</p>
						<button type="submit" id="btn_sig" class="btn btn-danger">Siguiente</button>
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
		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>
	</body>
</html>