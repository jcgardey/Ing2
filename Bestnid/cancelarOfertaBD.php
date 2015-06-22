<?php 
	include("session.php"); 

	if (!isset($_GET["idOferta"]) || !isset($_GET["idSubasta"]) ) {
		header ("Location: home.php");
	}

	include("conexion.php");
	$oferta = mysqli_query($link,"SELECT * FROM Oferta WHERE idUsuario='".$_SESSION["idUsuario"]."' and idOferta='".$_GET["idOferta"]."'
	and idSubasta='".$_GET["idSubasta"]."' ")
	or die (mysqli_error($link));

	if (mysqli_num_rows($oferta) ==1 ) {
		mysqli_query($link,"DELETE FROM Oferta WHERE idUsuario='".$_SESSION["idUsuario"]."' and idOferta='".$_GET["idOferta"]."'
		and idSubasta='".$_GET["idSubasta"]."' ")
		or die (mysqli_error($link));	
	}

	header("Location: home.php");
?>