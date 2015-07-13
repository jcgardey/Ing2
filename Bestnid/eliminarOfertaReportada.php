<?php 
	include("sessionAdmin.php"); 

	if (!isset($_GET["idOferta"]) ) {
		header ("Location: home.php");
	}

	include("conexion.php");
	$existeOferta = mysqli_query($link,"SELECT * FROM Oferta  WHERE Oferta.idOferta='".$_GET["idOferta"]."' ") or die (mysqli_error($link));

	
	if (mysqli_num_rows($existeOferta)== 1) {
		mysqli_query($link,"DELETE FROM Oferta WHERE idOferta='".$_GET["idOferta"]."' ") or die (mysqli_error($link));	
	}
	header("Location: reportes.php");
?>