<?php
	include("sessionAdmin.php");
	include("conexion.php");

	//chequear que la oferta este realmente reportada
	$existeOFerta = mysqli_query ($link, "SELECT * FROM Oferta WHERE Oferta.idOferta='".$_GET["idOferta"]."' and Oferta.reportada = 1 ");

	if (mysqli_num_rows($existeOFerta)==0 || !isset($_GET["idOferta"]) || !$_SESSION["admin"] ) {
		header ("Location: home.php");
	}
	else {
		$actualizarOferta = mysqli_query ($link, "UPDATE Oferta SET reportada = 0 WHERE Oferta.idOferta ='".$_GET["idOferta"]."' ");
		header ("Location: reportes.php");
	}
?>

