<?php 
	include("session.php"); 
	include("conexion.php");
	if (!isset($_GET["idSubasta"])) {
		header ("Location: home.php");
	}
	//chequear que la subasta esté activa y que el usuario logueado sea el subastador
	$existeSubasta= mysqli_query($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' and estado='activa' ") or die (mysqli_error($link));
	if (mysqli_num_rows($existeSubasta)==0) {
		header ("Location:home.php");
	}

	$resultado = mysqli_query($link, "SELECT Producto.nombre, Producto.descripcion, Categoria.nombre AS nombreCategoria, Subasta.fecha_cierre FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto INNER JOIN Categoria ON Producto.idCategoria=Categoria.idCategoria WHERE idSubasta='".$_GET["idSubasta"]."' ");
	$datosDelProducto=mysqli_fetch_array($resultado);
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
		<script src="Bootstrap/js/validarProducto.js"></script>
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
					<div class="col-md-3">
						<h2><strong>Editar Subasta</strong></h2>
					</div>
					<div class="col-md-7">
						<form name="frm-producto" id="f_producto" method="post" action="actualizarSubasta.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="inputNombre">Nombre<span class="text-danger">*</span></label>
								<div class="form-inline">
									<input type="text" class="form-control" name="nombre" id="inputNombre" value="<?php echo $datosDelProducto["nombre"]; ?>" >
								</div>
								<div id="campoNombre">
								</div>
							</div>			
							<div class="form-group">
								<label for="inputDesc">Descripci&oacute;n del Producto<span class="text-danger">*</span></label>
								<textarea class="form-control" rows="5" name="descripcion" id="inputDesc"><?php echo $datosDelProducto["descripcion"]; ?> </textarea>
								<div id="campoDescripcion">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCategoria">Elegir Cateogor&iacute;a<span class="text-danger">*</span></label>
								<select class="form-control" name="categoria" id="inputCategoria" value="<?php echo $datosDelProducto ["nombreCategoria"]; ?>">
									<?php
										include("conexion.php");
										$result = mysqli_query ($link, "SELECT nombre FROM Categoria");
										while ($row=mysqli_fetch_array($result) ) {
											echo "<option value=".$row["nombre"].">".$row["nombre"]."</option>";
										}
									?>
								</select>
								<div id="campoCategoria">
								</div>
							</div>
							<div class="form-group">
				                <label for="datepicker">Fecha de cierre<span class="text-danger">*</span></label>
				                <input type="text" id="datepicker" name="fecha" class="form-control" 
				                value="<?php echo date('d/m/Y',strtotime($datosDelProducto["fecha_cierre"])); ?>" readonly="readonly" />
				                <div id="campoFecha">
								</div>
	           				</div>
							<div class="form-group">
								<label>Elegir Imagen (jpg o png)<span class="text-danger">*</span></label>
								<div class="form-inline">
									<input class='btn btn-lg btn-default' type="file" name="imagen_fls" />
								</div>
								<div id="campoImagen">
									<?php
										if ( (isset($_GET["error"]) ) && ($_GET["error"]=="formato") ) { ?>
											<p class="text-danger">Ingresar una imagen es obligatorio</p>
									<?php } ?>
								</div>
							</div>
							<input type="hidden" name="idSubasta" value="<?php echo $_GET["idSubasta"]; ?>" />
							<p class="text-danger">*Campo obligatorio</p>
							<p class="text-danger">Todas las subastas finalizan a las 23:59hs</p>
							<button type="button" id="btn_sig" class="btn btn-danger">Siguiente</button>
							<a href="home.php" class="btn btn-default">Cancelar</a>
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