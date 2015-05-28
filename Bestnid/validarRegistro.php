
<?php
	include("conexion.php");
	$result = mysqli_query ($link, "SELECT * FROM Usuario WHERE nombre_usuario='".$_POST["nombreUsuario"]."' ");
	$num = mysqli_num_rows($result);
	if ($num  != 0) { 
			header("Location: registrarse.php?errorUsuario=si");
	}
	else {
			$result = mysqli_query ($link, "INSERT INTO `bestnid`.`usuario` (`nombre`,`apellido`,`telefono`, `nombre_usuario`,
				`password`, `e_mail`, `confirmado`, `estado`,`calle`,`numero_calle`,`piso`,`depto`) VALUES ('".$_POST["nombres"]."',
			'".$_POST["apellidos"]."', '".$_POST["telefono"]."', '".$_POST["nombreUsuario"]."', '".$_POST["password"]."',
			'".$_POST["email"]."', 0, 'activo', '".$_POST["domicilioCalle"]."', '".$_POST["domicilioNumero"]."',
			 '".$_POST["domicilioPiso"]."','".$_POST["domicilioDepto"]."') ");
		session_start();
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]= $_POST["nombreUsuario"];
		$result = mysqli_query ($link, "SELECT idUsuario FROM Usuario WHERE nombre_usuario='".$_POST["nombreUsuario"]."' ");
		$row=mysqli_fetch_array($result);
		$_SESSION["idUsuario"]= $row["idUsuario"];
		header("Location: home.php");
	} 

?> 