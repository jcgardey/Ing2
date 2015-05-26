
<?php

	include("conexion.php");
	$result = mysqli_query ($link, "SELECT * FROM Usuario WHERE nombre='".$_POST["nombreUsuario"]."' ");
	$num = mysqli_num_rows($result);
	if ($num  != 0) { 
			header("Location: registrarse.php?errorUsuario=si");
	}
	else {
		if(isset($_POST["domicilioPiso"])) {
			echo "entro";
			$result = mysqli_query ($link, "INSERT INTO `bestnid`.`usuario` (`nombre`,`apellido`,`telefono`, `nombre_usuario`,
				`password`, `e_mail`, `confirmado`, `estado`,`calle`,`numero_calle`, `piso`, `depto`) VALUES ('".$_POST["nombres"]."',
			'".$_POST["apellidos"]."', '".$_POST["telefono"]."', '".$_POST["nombreUsuario"]."', '".$_POST["password"]."',
			'".$_POST["email"]."', 0, 'activo', '".$_POST["domicilioCalle"]."', '".$_POST["domicilioNumero"]."',
			'".$_POST["domicilioPiso"]."','".$_POST["domicilioDepto"]."') ");
		}
		else {
			$result = mysqli_query ($link, "INSERT INTO `bestnid`.`usuario` (`nombre`,`apellido`,`telefono`, `nombre_usuario`,
				`password`, `e_mail`, `confirmado`, `estado`,`calle`,`numero_calle`) VALUES ('".$_POST["nombres"]."',
			'".$_POST["apellidos"]."', '".$_POST["telefono"]."', '".$_POST["nombreUsuario"]."', '".$_POST["password"]."',
			'".$_POST["email"]."', 0, 'activo', '".$_POST["domicilioCalle"]."', '".$_POST["domicilioNumero"]."') ");
		}		

		session_start();
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]= $_POST["nombreUsuario"];
		header("Location: home.php");
	} 

?> 