<?php
	include ("conexion.php");
	include("session.php");
	if (!isset($_GET["texto"]) && !isset($_GET["idSubasta"]) ) {
		header("Location:home.php");
	}
	
	//chequear que la subasta exista
	$existeSubasta=mysqli_query ($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));
	if (mysqli_num_rows($existeSubasta)>0) {
		$result= mysqli_query ($link, "INSERT INTO `bestnid`.`comentario` (`texto`,`idUsuario`,`idSubasta`) 
			VALUES ('".$_GET["texto"]."', '".$_SESSION["idUsuario"]."',	'".$_GET["idSubasta"]."' ) ");
		header("Location: verSubasta.php?idSubasta=".$_GET["idSubasta"]."");
	}
	else {
		header("Location:home.php");
	}
?>