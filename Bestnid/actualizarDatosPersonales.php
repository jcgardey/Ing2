<?php
	include("conexion.php");
	include("session.php");
	mysqli_query ($link, "UPDATE Usuario SET nombre='".$_POST["nombres"]."', apellido='".$_POST["apellidos"]."', telefono='".$_POST["telefono"]."', 
		numero_calle='".$_POST["domicilioNumero"]."', e_mail='".$_POST["e_mail"]."', piso='".$_POST["domicilioPiso"]."',
		depto='".$_POST["domicilioDepto"]."', calle='".$_POST["domicilioCalle"]."' WHERE idUsuario='".$_SESSION["idUsuario"]."' ") or die(mysqli_error($link));

	header("Location: home.php");
?>