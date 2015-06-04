<?php
	include ("conexion.php");
	include("session.php");
	if (!isset($_GET["monto"]) || !isset($_GET["razon"]) ) {
		header("Location:home.php");
	}
	$result= mysqli_query ($link, "INSERT INTO `bestnid`.`oferta` (`razon`, `monto`, `fecha`, `idUsuario`,`idSubasta`) 
		VALUES ('".$_GET["razon"]."', '".$_GET["monto"]."', current_date(), '".$_SESSION["idUsuario"]."', 
			'".$_GET["idSubasta"]."' ) ");
	header("Location: home.php");
?>