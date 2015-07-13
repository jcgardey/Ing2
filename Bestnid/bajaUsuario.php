<?php
	include("session.php");
	include("conexion.php");
	
	$usuario = mysqli_query ($link, "SELECT * FROM Usuario WHERE idUsuario='".$_SESSION["idUsuario"]."' ");
	if (mysqli_num_rows($usuario)>0 && !$_SESSION["admin"]) {
		$result= mysqli_query ($link, "UPDATE Usuario 
		SET estado='inactivo' WHERE idUsuario='".$_SESSION["idUsuario"]."' ");
		include("salir.php");
	}
	else {
		header("Location: home.php");
	}
?>