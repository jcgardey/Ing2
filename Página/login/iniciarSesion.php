
<<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesio&acute;n en Bestnid</title>
	<meta charset="utf-8"/>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../Bootstrap/css/bootstrap-theme.min.css">
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
					<a class="navbar-brand" rel="home" href="../index.php" title="Logotipo">
        				<img style="max-height:100%;,max-width:100%;" src="../logo.png" />
    				</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
									<?php			          
									include("Bestnid/conexion.php");
									$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
									while ($row=mysqli_fetch_array($result) ) {
											echo "<li><a href=#>".$row["nombre"]."</a></li>";
									}
									?>			           
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar producto">
						</div>
						<button type="submit" class="btn btn-default">Buscar</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a class="navbar-brand" href="Bestnid/registrarse.php">Registrarse</a>
						</li>
						<li>
							<a class="navbar-brand" href="Bestnid/login/iniciarSesion.php">Ingresar</a>
						</li>
						<li>
							<a class="navbar-brand" href="#">Contacto</a>
						</li>
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
	</header>
</body>
</html>
</html>