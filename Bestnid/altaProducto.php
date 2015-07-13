<?php include("session.php"); ?>
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
		<script>
			 $.datepicker.regional['es'] = {
			 closeText: 'Cerrar',
			 prevText: '<Ant',
			 nextText: 'Sig>',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			 weekHeader: 'Sm',
			 dateFormat: 'dd/mm/yy',
			 firstDay: 1,
			 isRTL: false,
			 showMonthAfterYear: false,
			 yearSuffix: ''
			 };
			 $.datepicker.setDefaults($.datepicker.regional['es']);
			
			
			 <?php
			 	include("conexion.php");
			 	$result= mysqli_query ($link, "SELECT * FROM Configuracion WHERE clave='duracion_maxima'");
			 	$row=mysqli_fetch_array($result);
			 ?>
					
			$(function () {
			var d=<?php echo $row["valor"]; ?>;
			var max= "+" + d + "D";
			$("#datepicker").datepicker({ minDate:"+1D", maxDate:max});
			});
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
					<div class="col-md-3">
						<h2><strong>Agrega tu Producto</strong></h2>
					</div>
					<div class="col-md-7">
						<form name="frm-producto" id="f_producto" method="post" action="subirImagen.php" enctype="multipart/form-data">
							<div class="form-group">
								<label for="inputNombre">Nombre<span class="text-danger">*</span></label>
								<div class="form-inline">
									<input type="text" class="form-control" name="nombre" id="inputNombre" value=<?php if (isset($_GET["nombre"])) { echo $_GET["nombre"]; } else { echo '""';} ?> >
								</div>
								<div id="campoNombre">
								</div>
							</div>			
							<div class="form-group">
								<label for="inputDesc">Descripci&oacute;n del Producto<span class="text-danger">*</span></label>
								<textarea class="form-control" rows="5" name="descripcion" id="inputDesc"><?php if (isset($_GET["descripcion"])) { echo $_GET["descripcion"]; } else { echo "";} ?></textarea>
								<div id="campoDescripcion">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCategoria">Elegir Cateogor&iacute;a<span class="text-danger">*</span></label>
								<select class="form-control" name="categoria" id="inputCategoria" >
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
				                <input type="text" id="datepicker" name="fecha" class="form-control" readonly="readonly" />
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
							<p class="text-danger">*Campo obligatorio</p>
							<p class="text-danger">Todas las subastas finalizan a las 23:59hs</p>
							<button type="button" id="btn_sig" class="btn btn-danger">Siguiente</button>
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