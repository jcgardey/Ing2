<?php
	include("sessionAdmin.php");
	include("conexion.php");
	if(!isset($_GET["idUsuario"]) || !$_SESSION["admin"]){
		header("Location:home.php");
	}
	else {
		$usuario = mysqli_query ($link, "SELECT * FROM Usuario WHERE idUsuario='".$_GET["idUsuario"]."' ");
		if (mysqli_num_rows($usuario)>0) {
			$result= mysqli_query ($link, "UPDATE Usuario 
			SET estado='activo' WHERE idUsuario='".$_GET["idUsuario"]."' ");
		}
		header("Location: adminUsuarios.php");
	}
?>