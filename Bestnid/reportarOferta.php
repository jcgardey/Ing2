<?php
	include("session.php");
	include("conexion.php");

	//chequear que la subasta a la cual pertenece la oferta este activa y que la oferta no haya sido reportada
	$existeOferta = mysqli_query ($link, "SELECT Subasta.idSubasta FROM Oferta INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta 
		WHERE Oferta.idOferta='".$_GET["idOferta"]."' and Subasta.estado <> 'cerrada' and Oferta.reportada = 0 ") or die (mysqli_error($link));

	//el administrador no puede reportar
	if (mysqli_num_rows($existeOferta)==0 || !isset($_GET["idOferta"]) || $_SESSION["admin"]) {
		header ("Location: home.php");
	}
	else {
		$subasta = mysqli_fetch_array ($existeOferta);
		$actualizarOferta = mysqli_query ($link, "UPDATE Oferta SET reportada = 1 WHERE Oferta.idOferta ='".$_GET["idOferta"]."' ");
		header ("Location: verSubasta.php?idSubasta=".$subasta["idSubasta"]." ");
	}
?>