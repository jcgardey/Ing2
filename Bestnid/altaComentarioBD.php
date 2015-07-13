<?php
	include ("conexion.php");
	include("session.php");
	if (!isset($_GET["texto"]) && !isset($_GET["idSubasta"]) ) {
		header("Location:home.php");
	}
	
	//chequear que la subasta exista, que esté activa y que el usuario logueado no sea el subastador
	$existeSubasta=mysqli_query ($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and estado='activa' and idUsuario<>'".$_SESSION["idUsuario"]."' ") or die (mysqli_error($link));
	
	$usuarioYaHizoComentario = mysqli_query ($link, "SELECT * FROM Comentario WHERE idUsuario='".$_SESSION["idUsuario"]."' and idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($lin));
	if (mysqli_num_rows($existeSubasta)>0 && mysqli_num_rows($usuarioYaHizoComentario)==0) {
		$result= mysqli_query ($link, "INSERT INTO `bestnid`.`comentario` (`texto`,`idUsuario`,`idSubasta`) 
			VALUES ('".$_GET["texto"]."', '".$_SESSION["idUsuario"]."',	'".$_GET["idSubasta"]."' ) ");
		header("Location: verSubasta.php?idSubasta=".$_GET["idSubasta"]."");
	}
	else {
		header("Location:home.php");
	}
?>