<?php
	include("sessionAdmin.php");
	include("conexion.php");
	if(!isset($_GET["idUsuario"]) || !$_SESSION["admin"]){
		header("Location:home.php");
	}
	else {
		//chequear que el usuario a inactivar exista y que no sea administrador
		$usuario = mysqli_query ($link, "SELECT * FROM Usuario WHERE idUsuario='".$_GET["idUsuario"]."' and nombre_usuario <> 'admin' ");
		if (mysqli_num_rows($usuario)>0) {
			$result= mysqli_query ($link, "UPDATE Usuario 
			SET estado='inactivo' WHERE idUsuario='".$_GET["idUsuario"]."' ");
		}
		header("Location: home.php");
	}
?>