<?php
	include ("sessionAdmin.php");
	include ("conexion.php");

	if (!isset($_POST["respuesta"]) || !isset($_POST["idMensaje"])) {
		header ("Location: home.php");
	}
	else {
		$responderMensaje = mysqli_query($link, "UPDATE Mensaje SET respuesta='".$_POST["respuesta"]."' WHERE idMensaje='".$_POST["idMensaje"]."' ");
		header ("Location: mensajesAdministrador.php");
	}
?>