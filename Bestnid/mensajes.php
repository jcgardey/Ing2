<?php 
	include ("session.php"); 
	//el administrador no puede ingresar a este sitio
	if ($_SESSION["admin"]) {
		header ("Location: home.php");
	}
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
				$("#btn_mensaje").click(function() {
					if (!$("#inputTexto").val()) {
						$("#campoTexto").html("<p class='text-danger'>Complete este campo</p>");
						$("#inputTexto").focus();
					}
					else {
						$("#f_mensaje").submit();
					}
				});
			
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
		        <div class="col-sm-3 col-md-9">
		        	<div class="row">
		        		<?php 
		        			//marcar como leidas las respuestas nuevas
		        			$actualizarMensajes = mysqli_query ($link, "UPDATE Mensaje SET respuestaLeida=1 WHERE respuestaLeida=0 and idUsuario='".$_SESSION["idUsuario"]."' and respuesta is not null ");

		        			$mensajesDeUsuario = mysqli_query ($link, "SELECT * FROM Mensaje WHERE idUsuario='".$_SESSION["idUsuario"]."' ");

		        			if (mysqli_num_rows($mensajesDeUsuario)==0) { ?>
								<h3><strong>No ha enviado ning&uacute;n mensaje</strong></h3>		        				
		        	 <?php  } 
		        	 		else { ?>
		        	 			<h3><strong>Mensajes Enviados</strong></h3>
								<?php
								while ($tuplaMensaje=mysqli_fetch_array($mensajesDeUsuario)) { ?>
									<div class="panel panel-default">
									 	<div class="panel-body">
											<p class="text-justify"><?php echo $tuplaMensaje["mensaje"]; ?></p>								    
									 	<?php if ($tuplaMensaje["respuesta"]) { ?>
									 		<hr>
									 		<div class="col-md-offset-1">
									 			<p class="text-justify"><?php echo $tuplaMensaje["respuesta"]; ?></p>
									 		</div>
									 	<?php } ?>
									 	</div>
									</div>
					<?php		}		        	
		        		    } ?>
		        		
		        	</div>
		        	<hr>
		        	<div class="row">
			        	<h3><strong>Enviar un mensaje al administrador</strong></h3>
			        	<form name='frm-mensaje' id='f_mensaje' method='post' action='enviarMensaje.php'>		
							<div class='form-group'>
								<textarea class='form-control' rows='4' name='texto' id='inputTexto'></textarea>
								<div id='campoTexto'>
								</div>
							</div>
							<button type='button' id='btn_mensaje' class='btn btn-danger'>Enviar</button>
						</form>
					</div>
		        </div>
		    </div>
		</section>
	</body>
</html>