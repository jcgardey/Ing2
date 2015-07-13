<?php
	include ("session.php");
	include ("conexion.php");

	//chequear que la subasta exista, que su estado sea activa y que no haya sido reportada
	$existeSubasta = mysqli_query ($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and estado <>'cerrada' and reportada=0 ");
	
	//si el usuario logueado es administrador no puede reportar
	if (!isset($_GET["idSubasta"]) || mysqli_num_rows($existeSubasta)==0 || $_SESSION["admin"]) {
		header ("Location: home.php");
	} 
	else {
		$actualizarSubasta= mysqli_query ($link, "UPDATE Subasta SET reportada=1 WHERE idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));
		header ("Location: verSubasta.php?idSubasta=".$_GET["idSubasta"]."");
	}