<?php
	include ("session.php");
	include ("conexion.php");

	if (!isset($_POST["texto"])) {
		header ("Location: home.php");
	}
	else {
		$insertarMensaje = mysqli_query($link, "INSERT INTO Mensaje (mensaje, idUsuario, fecha) VALUES ('".$_POST["texto"]."','".$_SESSION["idUsuario"]."', current_date())");
		header ("Location: mensajes.php");
	}
?>