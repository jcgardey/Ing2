<?php
	include ("sessionAdmin.php");
	include ("conexion.php");

	$existeSubastaReportada = mysqli_query($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and reportada=1");
	if (!isset($_GET["idSubasta"]) || mysqli_num_rows($existeSubastaReportada)==0) {
		header ("Location: home.php");
	}
	else {
		$actualizarSubasta = mysqli_query ($link, "UPDATE Subasta SET reportada=0 WHERE idSubasta='".$_GET["idSubasta"]."' ");
		header ("Location: reportes.php");
	}
?>