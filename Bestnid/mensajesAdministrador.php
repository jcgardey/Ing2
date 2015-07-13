<?php 
	include ("sessionAdmin.php"); 
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

		<script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.js"></script>

		<script>
			$(document).ready(function(){
				$("#btnRespuesta").click(function() {
					if (!$("#inputTexto").val()) {
						$("#campoTexto").html("<p class='text-danger'>Complete este campo</p>");
						$("#inputTexto").focus();
					}
					else {
						$("#f_mensaje").submit();
					}
				});
			
			});
			function validarCampo (id, idCampoError, idFormulario) {
				if (!$("#" + id).val()) {
					$("#" + idCampoError).html("<p class='text-danger'>Complete este campo</p>");
					$("#" + id).focus();
				}
				else {
					$("#" + idFormulario).submit();
				}
			}
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
		        <div class="col-sm-3 col-md-9">
		        	<div class="row">
		        		<?php 
		        			$mensajesNuevos = mysqli_query ($link, "SELECT * FROM Mensaje INNER JOIN Usuario 
		        				ON Mensaje.idUsuario=Usuario.idUsuario WHERE leido=0 and respuesta is null
		        				ORDER BY fecha DESC");

		        			if (mysqli_num_rows($mensajesNuevos)==0) { ?>
								<h3><strong>No hay Mensajes Nuevos</strong></h3>		        				
		        	 <?php  } 
		        	 		else { ?>
		        	 			<h3><strong>Mensajes Nuevos</strong></h3>
								<?php
								$id=1;
								while ($tuplaMensaje=mysqli_fetch_array($mensajesNuevos)) { ?>
									<div class="panel panel-default">
									 	<div class="panel-body">
											<a href="verPerfilDeUsuario.php?idUsuario=<?php echo $tuplaMensaje["idUsuario"];?>"><?php echo $tuplaMensaje["nombre_usuario"]; ?></a>
											<br />
											<p class="text-justify"><?php echo $tuplaMensaje["mensaje"]; ?></p>					
									 		<hr>
									 		<div class="col-md-offset-1">
									 			<form name='frm-respuesta' id='f_respuesta<?php echo $id; ?>' method='post' action='enviarRespuesta.php'>		
													<div class='form-group'>
														<textarea class='form-control' rows='4' name='respuesta' id='inputTexto<?php echo $id; ?>'></textarea>
														<div id='campoTexto<?php echo $id; ?>'>
														</div>
													</div>
													<input type="hidden" name="idMensaje" value="<?php echo $tuplaMensaje["idMensaje"]; ?>">
													<button type='button' id='btn_respuesta' class='btn btn-danger'
													onclick="validarCampo('inputTexto<?php echo $id; ?>', 'campoTexto<?php echo $id; ?>','f_respuesta<?php echo $id; ?>')">Responder</button>
												</form>			
									 		</div>
									 	</div>
									</div>
					<?php		$id=$id+1;
								}		        	
		        		    } ?>
							<hr>
							<?php
								$todosLosMensajes = mysqli_query ($link, "SELECT * FROM Mensaje INNER JOIN Usuario 
		        				ON Mensaje.idUsuario=Usuario.idUsuario ORDER BY fecha DESC");
								$id=1;
								while ($tuplaMensaje=mysqli_fetch_array($todosLosMensajes)) { ?>
									<div class="panel panel-default">
									 	<div class="panel-body">
											<a href="verPerfilDeUsuario.php?idUsuario=<?php echo $tuplaMensaje["idUsuario"];?>"><?php echo $tuplaMensaje["nombre_usuario"]; ?></a>
											<br />
											<p class="text-justify"><?php echo $tuplaMensaje["mensaje"]; ?></p>					
									 		<hr>
									 		<div class="col-md-offset-1">
									 			<?php if (!$tuplaMensaje["respuesta"]) { ?>
										 			<form name='frm-respuesta' id='f_respuesta<?php echo $id; ?>' method='post' action='enviarRespuesta.php'>		
														<div class='form-group'>
															<textarea class='form-control' rows='4' name='respuesta' id='inputTexto<?php echo $id; ?>'></textarea>
															<div id='campoTexto<?php echo $id; ?>'>
															</div>
														</div>
														<input type="hidden" name="idMensaje" value="<?php echo $tuplaMensaje["idMensaje"]; ?>">
														<button type='button' id='btn_respuesta' class='btn btn-danger'
														onclick="validarCampo('inputTexto<?php echo $id; ?>', 'campoTexto<?php echo $id; ?>','f_respuesta<?php echo $id; ?>')">Responder</button>
													</form>	
												<?php } 
												else { ?>
													<p class="text-justify"><?php echo $tuplaMensaje["respuesta"]; ?></p>
												<?php } ?>			
									 		</div>
									 	</div>
									</div>
					<?php		$id=$id+1;
								}	?>
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
<?php
	//marcar como leidos los mensajes que todavia no fueron marcados
	$actualizarMensajes = mysqli_query ($link, "UPDATE Mensaje SET leido=1 WHERE leido=0 ");
?>