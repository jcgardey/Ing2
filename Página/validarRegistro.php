
<?php
	
	include("conexion.php");
	$result = mysqli_query ($link, "SELECT * FROM Usuario WHERE nombre='".$_POST["inputEmail"]."' ");
	$num = mysqli_num_rows($result);
	if ($_POST["inputPassword"] != $_POST["inputConfirmarPassword"] || $num != 0 ||
		$_POST["inputPassword"]=="" || $_POST["inputEmail"]=="" || $_POST["inputConfirmarPassword"]=="") { 
			header("Location: registrarse.php?error=si");
	}
	
	else {
		$result = mysqli_query ($link, "INSERT INTO `bestnid`.`usuario` (`nombre`, `password`) VALUES ('".$_POST["inputEmail"]."',
			'".$_POST["inputPassword"]."') ");
		session_start();
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]= $_POST["inputEmail"];
		header("Location: home.php");
	}

?>