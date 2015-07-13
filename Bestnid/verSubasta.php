<?php session_start(); ?>
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
		<script src="Bootstrap/js/validarRegistro.js"></script>
		<script>
			window.onload = function () {
				document.getElementById("btn_comentario").onclick = validarFormComentar;
			}
			
			function validarFormComentar () {
				if (validarCampoObligatorio("inputTexto","campoTexto")) {
					document.getElementById("f_comentario").submit();
				}
			}

			function validarFormRespuesta (idForm,id, idCampoError) {
				if (validarCampoObligatorio(id, idCampoError)) {
					document.getElementById(idForm).submit();
				}
			}

			function reportarSubasta () {
				if (confirm("¿Está seguro que desea reportar esta subasta?")) {
					window.location ='<?php echo "reportarSubasta.php?idSubasta=".$_GET["idSubasta"]."";?>';
				} 
			}


			 function reportarOferta (idOferta) {
				if (confirm("¿Está seguro que desea reportar esta oferta?")) {
					window.location ="reportarOferta.php?idOferta=" + idOferta;
				}	 
			}
									
		</script>
	</head>
	<body>
		
		<?php 
			if (!isset($_GET["idSubasta"]) ) {
				header("Location: home.php");
			}
			
			if (isset($_SESSION["admin"]) && $_SESSION["admin"]==true) {
				include ("navbarAdmin.html"); 
			}
			elseif (isset($_SESSION["admin"]) && $_SESSION["admin"]==false) {
				include ("navbar.html"); 
			} else {
				include ("navbarIndex.html");
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
				<div class="col-md-9">
					<div class="row well well-lg">	
						<?php
							include ("conexion.php");
							$result = mysqli_query ($link, "SELECT Subasta.idUsuario, Subasta.reportada, Subasta.fecha_cierre, Producto.imagen, Subasta.estado, Producto.descripcion, Producto.nombre, Categoria.nombre AS nomCat, Usuario.nombre_usuario 
							 	FROM Subasta INNER JOIN Producto ON Subasta.idProducto=Producto.idProducto INNER JOIN Categoria ON Categoria.idCategoria=Producto.idCategoria INNER JOIN Usuario ON Subasta.idUsuario=Usuario.idUsuario 
								WHERE idSubasta='".$_GET["idSubasta"]."' ");

							//en caso de que la subasta no exista..
							if (mysqli_num_rows($result)==0) {
								header("Location: home.php");
							}
					
							$row=mysqli_fetch_array($result);
							

							//cambiar estado de la subasta en caso que se haya alcanzado su fecha de cierre
							$cerrarSubastas=mysqli_query ($link, "UPDATE Subasta SET estado='finalizada' WHERE estado='activa' and idSubasta='".$_GET["idSubasta"]."' and fecha_cierre <= current_date()  ");

							//evaluar en caso de que haya un usuario logueado, si ya hizo una oferta en esta subasta
							if (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"]==true) {
								$existeOfertaDeUsuario=mysqli_query ($link, "SELECT * FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
								$cantidadOfertasDeUsuario = mysqli_num_rows ($existeOfertaDeUsuario);
								$ofertaDeUsuario =  mysqli_fetch_array($existeOfertaDeUsuario);
							}
							//evaluar en caso de que haya un usuario logueado, si ya hizo un comentario en esta subasta
							if (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"]==true) {
								$existeComentarioDeUsuario=mysqli_query ($link, "SELECT * FROM Comentario WHERE idSubasta='".$_GET["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' ");
								$cantidadComentariosDeUsuario = mysqli_num_rows ($existeComentarioDeUsuario);
								$comentarioDeUsuario =  mysqli_fetch_array($existeComentarioDeUsuario);
							}
						?>
			
						<div class="col-md-6">
							<!--<img src='<?php echo $row["imagen"]; ?>' class="img-responsive" alt="imagen"> -->
							<a href='<?php echo $row["imagen"]; ?>' target="_blank"><img src='<?php echo $row["imagen"]; ?>' class="img-responsive" alt="descripcion" /></a> 
						</div>
						<div class="col-md-6">
							<div class="row">
							<?php
								if ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]!=$_SESSION["idUsuario"] && $cantidadOfertasDeUsuario==0) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='altaOferta.php?idSubasta=".$_GET["idSubasta"]." '>Ofertar</a></div>";
								} if ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]!=$_SESSION["idUsuario"] && $cantidadOfertasDeUsuario>0) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='editarOferta.php?idOferta=".$ofertaDeUsuario["idOferta"]."'>Editar Oferta</a></div>";
									echo "<div class='col-md-4'><a class='btn btn-danger' href='verOfertaCancelar.php?idOferta=".$ofertaDeUsuario["idOferta"]."'>Cancelar Oferta</a></div>";
								} if ($row["estado"]=='finalizada' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"]) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='elegirGanador.php?idSubasta=".$_GET["idSubasta"]." '>Elegir Ganador</a></div>";
								} if ($row["estado"]!='cerrada' && isset($_SESSION["idUsuario"]) && ($row["idUsuario"]==$_SESSION["idUsuario"] || $_SESSION["admin"])) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='cancelarSubasta.php?idSubasta=".$_GET["idSubasta"]." '>Cancelar Subasta</a></div>";
								} if ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"] ) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='editarSubasta.php?idSubasta=".$_GET["idSubasta"]." '>Editar Subasta</a></div>";
								}
								$hayOfertaGanadora= mysqli_query($link,"SELECT Oferta.idOferta, Venta.comisionPagada FROM Venta INNER JOIN Oferta ON Venta.idOferta=Oferta.idOferta WHERE Oferta.idSubasta='".$_GET["idSubasta"]."'");
								$ofertaGanadora=mysqli_fetch_array ($hayOfertaGanadora);

								if ($row["estado"]=='cerrada' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"] && !$_SESSION["admin"] && mysqli_num_rows($hayOfertaGanadora)==1 && $ofertaGanadora["comisionPagada"]==0) {
									echo "<div class='col-md-4'><a class='btn btn-danger' href='pagarComision.php?idOferta=".$ofertaGanadora["idOferta"]." '>Pagar Comisi&oacute;n</a></div>";
								}
							?>
							</div>
							<div class="row">
								<h4><strong>Vendedor: </strong></h4>
								<?php echo "<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$row["idUsuario"]."'>".$row["nombre_usuario"]."</a>"; ?>
							</div>
							<div class="row">
								<h4><strong>Nombre del producto: </strong></h4>
								<?php echo "<p class='lead'>".$row["nombre"]."</p>"; ?>
							</div>
							<div class="row">	
								<h4><strong>Descripci&oacute;n: </strong></h4>
								<?php echo "<p class='lead'>".$row["descripcion"]."</p>"; ?>
							</div>
							<div class="row">	
								<h4><strong>Categor&iacute;a: </strong></h4>
								<?php echo "<p class='lead'>".$row["nomCat"]."</p>"; ?>
							</div>
							<div class="row">
								<h4><strong>Finaliza: </strong></h4>
								<?php echo "<p class='lead'>".date('d-m-Y',strtotime($row["fecha_cierre"]))."</p>"; ?>
							</div>
							<div class="row">
								<h4><strong>Estado: </strong></h4>
								<?php echo "<p class='lead'>".$row["estado"]."</p>"; ?>
							</div>
							<div class="row">
							<?php 
								//para poder reportarse la subasta debe estar activa o finalizada, no tiene que haber sido reportada todavia, y el usuario logueado no debe ser administrador
								if ($row["estado"]!='cerrada' && $row["reportada"]=="0" && isset($_SESSION["idUsuario"]) && !$_SESSION["admin"]) {
									echo "<div class='row'><a class='btn btn-default' onclick='reportarSubasta()' href='#'>Reportar Subasta</a></div>";	
								}
								if (isset($_SESSION["idUsuario"]) && $row["reportada"]=="1") {
									echo "<h5 class='text-danger'><strong>ESTA SUBASTA HA SIDO REPORTADA</strong></h5>";
								}
							?>
							</div>
						</div>
					</div>
					<div class="row">
						<?php
							include ("conexion.php");
							
							//chequear si la subasta tiene una oferta ganadora
							if ($row["estado"]=='cerrada') {
								$hayOfertas=mysqli_query ($link, "SELECT * FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."'");
								
								if (mysqli_num_rows($hayOfertas) != 0) {
									//chequear si la subasta fue cerrada automáticamente por el sistema o el subastador eligió un ganador
									$result=mysqli_query ($link, "SELECT Oferta.idOferta,Oferta.razon,Usuario.idUsuario,Usuario.nombre_usuario, Venta.ofertaPagada FROM Oferta INNER JOIN Venta ON Oferta.idOferta=Venta.idOferta INNER JOIN Usuario ON Usuario.idUsuario=Oferta.idUsuario
										WHERE Oferta.idSubasta='".$_GET["idSubasta"]."' ");
									if (mysqli_num_rows($result)==0) {
										echo "<h3 class='text-danger'><strong>Esta subasta fue cerrada autom&aacute;ticamente por el sistema</strong></h3>";
									}
									else {
										$ofertaGanadora = mysqli_fetch_array($result);
										echo "<h3 class='text-danger'><strong>Oferta Ganadora</strong></h3>";
										echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$ofertaGanadora["idUsuario"]."'>".$ofertaGanadora["nombre_usuario"]."</a>
		  											</div>
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$ofertaGanadora["razon"]."</p>
		  											</div>";
		  										//solo si el usuario logueado es el subastador puede ver el ganador de la subasta en caso que lo haya
		  										if (isset($_SESSION["idUsuario"]) && ($_SESSION["idUsuario"]==$row["idUsuario"] || $_SESSION["admin"]==true) ) {
		  											echo "
		  											<div class='col-md-2'>
		  												<a class='btn btn-danger' href='visualizarGanador.php?idOferta=".$ofertaGanadora["idOferta"]."&idSubasta=".$_GET["idSubasta"]." '>Ver Ganador</a>
		  											</div>";
		  										}
		  										//si el usuario logueado es el dueño de la oferta ganadora y todavia no la pagó debe visualizarse la opción de pagar
		  										elseif (isset($_SESSION["idUsuario"]) && $ofertaGanadora["idUsuario"]==$_SESSION["idUsuario"] && $ofertaGanadora["ofertaPagada"]==0) {
		  											echo "
		  											<div class='col-md-2'>
		  												<a class='btn btn-danger' href='pagarOferta.php?idOferta=".$ofertaGanadora["idOferta"]."'>Pagar</a>
		  											</div>";
		  										}
		  										echo "
		  										</div>
		  								  	</div>
										  </div>";
									} 
								}
								else {
										echo "<h3 class='text-danger'><strong>Esta subasta finaliz&oacute; sin ofertas</strong></h3>";
								}	
							}
							//si el usuario logueado realizo una oferta debe visualizarse
							if (isset($_SESSION["idUsuario"])) {
								$usuarioRealizoOferta=mysqli_query($link,"SELECT * FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario WHERE Oferta.idSubasta='".$_GET["idSubasta"]."' and Oferta.idUsuario='".$_SESSION["idUsuario"]."' ");	
									if (mysqli_num_rows($usuarioRealizoOferta)>0) {
										$ofertaDeUsuario= mysqli_fetch_array($usuarioRealizoOferta);
										echo "<h3><strong>Mi Oferta</strong></h3>";
										echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$_SESSION["idUsuario"]."'>".$ofertaDeUsuario["nombre_usuario"]."</a>
		  											</div>
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$ofertaDeUsuario["razon"]."</p>
		  											</div>
		  										</div>
		  								  	</div>
										  </div>";
									}
							}
							
							//si el usuario logueado realizo un comentario debe visualizarse
							if (isset($_SESSION["idUsuario"])) {
								$existeComentarioDeUsuario=mysqli_query($link,"SELECT Usuario.idUsuario,Usuario.nombre_usuario, Comentario.texto,Comentario.respuesta 
									FROM Comentario INNER JOIN Usuario ON Comentario.idUsuario=Usuario.idUsuario WHERE Comentario.idSubasta='".$_GET["idSubasta"]."' and Comentario.idUsuario='".$_SESSION["idUsuario"]."' ");	
									if (mysqli_num_rows($existeComentarioDeUsuario)>0) {
										$comentarioDeUsuario= mysqli_fetch_array($existeComentarioDeUsuario);
										echo "<h3><strong>Mi Comentario</strong></h3>";
										echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$comentarioDeUsuario["idUsuario"]."'>".$comentarioDeUsuario["nombre_usuario"]."</a>
		  											</div>
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$comentarioDeUsuario["texto"]."</p>";
														if($comentarioDeUsuario["respuesta"]!=""){
															echo "<p class='lead text-danger'>Respuesta:</p>";
															echo "<p class='lead'>".$comentarioDeUsuario["respuesta"]."</p>";
														}
		  											echo "</div>
		  										</div>
		  								  	</div>
										  </div>";
									}
							}
							//se muestran las ofertas realizadas solo si el usuario logueado es el subastador o si no se pueden realizar mas ofertas en ella
							if ( (isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"]) || $row["estado"]!='activa') {
								//chequear si la subasta tiene alguna oferta
								$existenOfertasEnLaSubasta=mysqli_query($link,"SELECT * FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."' ");
								if (mysqli_num_rows($existenOfertasEnLaSubasta)>0) {
									echo "<h3><strong>Ofertas realizadas</strong></h3>";
								}
								else {
									echo "<h3><strong>No hay ofertas realizadas</strong></h3>";
								}
								
								$result= mysqli_query ($link, "SELECT Usuario.idUsuario,Usuario.nombre_usuario,Oferta.razon,Oferta.idOferta, Oferta.reportada FROM Oferta INNER JOIN Usuario ON Oferta.idUsuario=Usuario.idUsuario 
									WHERE Oferta.idSubasta='".$_GET["idSubasta"]."' ");
								while ($ofertaDeLaSubasta=mysqli_fetch_array($result) ) {
									echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$ofertaDeLaSubasta["idUsuario"]."'>".$ofertaDeLaSubasta["nombre_usuario"]."</a>
		  											</div>";
		  										//si la subasta esta activa o finalizada, la oferta no fue reportada y el usuario logueado no es administrador la oferta se puede reportar
		  										if ($row["estado"]!='cerrada' && $ofertaDeLaSubasta["reportada"]==0 && !$_SESSION["admin"]) { ?>
		  											<div class='col-md-2'>
		  												<a class='btn btn-default' onclick='reportarOferta(<?php echo $ofertaDeLaSubasta["idOferta"]; ?>)'>Reportar</a>
		  											</div>
		  										<?php } 
		  										if ($ofertaDeLaSubasta["reportada"]==1) {
		  											echo "
		  											<div class='col-md-2'>
		  												<p class='text-danger'>Esta oferta fue reportada</p>
		  											</div>";
		  										}
		  										echo "
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$ofertaDeLaSubasta["razon"]."</p>

		  											</div>
		  										</div>
		  								  	</div>
										  </div>";
								}
							}
							
							//se muestran los comentarios realizados independientemente de si el usuario logueado es el subastador o si no se pueden realizar mas comentarios en ella
							
								//chequear si la subasta tiene algun comentario
								$hayComentariosEnLaSubasta=mysqli_query($link,"SELECT * FROM Comentario WHERE idSubasta='".$_GET["idSubasta"]."' ");
								if (mysqli_num_rows($hayComentariosEnLaSubasta)>0) {
									echo "<h3><strong>Comentarios Realizados</strong></h3>";
								}
								else {
									echo "<h3><strong>No hay comentarios realizados</strong></h3>";
								}
								
								$result= mysqli_query ($link, "SELECT Comentario.idComentario, Comentario.texto,Comentario.respuesta, Usuario.idUsuario, Usuario.nombre_usuario 
									FROM Comentario INNER JOIN Usuario ON Comentario.idUsuario=Usuario.idUsuario 
									WHERE Comentario.idSubasta='".$_GET["idSubasta"]."' ");
								$numeroFormularioRespuesta=1;
								while ($comentarioDeLaSubasta=mysqli_fetch_array($result) ) {
									echo "<div class='panel panel-default row'>
		  									<div class='panel-body container-fluid'>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<a class='lead' href='verPerfilDeUsuario.php?idUsuario=".$comentarioDeLaSubasta["idUsuario"]."'>".$comentarioDeLaSubasta["nombre_usuario"]."</a>
		  											</div>
		  										</div>
		  										<div class='row'>
		  											<div class='col-md-10'>
		  												<p class='lead'>".$comentarioDeLaSubasta["texto"]."</p>
		  											</div>
		  										</div>";
												echo "
												<div class='row'>";
												if($comentarioDeLaSubasta["respuesta"]!="") {
												echo "<div class='col-md-10'>
													  	<p class='lead text-danger'>Respuesta:</p>
														<p class='lead'>".$comentarioDeLaSubasta['respuesta']."</p>
													  </div>";
												}	
												//si el usuario registrado es el subastador se ven los botones de responder a menos que la subasta no este activa o ya exista respuesta
												if(isset($_SESSION["idUsuario"]) && $row["idUsuario"]==$_SESSION["idUsuario"] && $row["estado"]=='activa' && $comentarioDeLaSubasta["respuesta"]=="") { ?>
													<div class='col-md-10'>
														<form name="frm-respuesta<?php echo $numeroFormularioRespuesta;?>" id="f_respuesta<?php echo $numeroFormularioRespuesta;?>" method='post' action='verRespuestaNuevo.php'>		
															<div class='form-group'>
																<textarea class='form-control' rows='5' name="respuesta" id="inputRespuesta<?php echo $numeroFormularioRespuesta;?>"></textarea>
																<div id="campoRespuesta<?php echo $numeroFormularioRespuesta;?>">
																</div>
															</div>
															<input type="hidden" name="idComentario" value="<?php echo $comentarioDeLaSubasta["idComentario"];?>" />
															<button type='button' onclick="validarFormRespuesta('f_respuesta<?php echo $numeroFormularioRespuesta;?>','inputRespuesta<?php echo $numeroFormularioRespuesta;?>','campoRespuesta<?php echo $numeroFormularioRespuesta;?>')" class='btn btn-danger'>Responder</button>
														</form>
													</div>	
										  <?php } ?>
		  										</div>
		  								  	</div>
										  </div>
								<?php $numeroFormularioRespuesta= $numeroFormularioRespuesta + 1;
								} 
							//hacer un comentario
							if ($row["estado"]=='activa' && isset($_SESSION["idUsuario"]) && $row["idUsuario"]!=$_SESSION["idUsuario"] && $cantidadComentariosDeUsuario==0) {
							echo "<h3><strong>Comentar</strong></h3>
								<div class='col-md-12'>
									<form name='frm-comentario' id='f_comentario' method='post' action='verComentarioNuevo.php'>		
										<div class='form-group'>
											<textarea class='form-control' rows='5' name='texto' id='inputTexto'></textarea>
											<div id='campoTexto'>
											</div>
										</div>
										<input type='hidden' name='idSubasta' value=".$_GET["idSubasta"]."/>
										<button type='button' id='btn_comentario' class='btn btn-danger'>Comentar</button>
									</form>
								 </div>";
							}	
						?>
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