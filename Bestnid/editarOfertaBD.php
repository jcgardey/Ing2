<?php 
	include("session.php"); 

	if (!isset($_GET["idOferta"]) || !isset($_GET["monto"])) {
		header ("Location: home.php");
	}

	include("conexion.php");
	$oferta = mysqli_query($link,"SELECT * FROM Oferta WHERE idUsuario='".$_SESSION["idUsuario"]."' and idOferta='".$_GET["idOferta"]."' ")
	or die (mysqli_error($link));

	if (mysqli_num_rows($oferta) ==1 ) {
		mysqli_query($link,"UPDATE Oferta SET monto='".$_GET["monto"]."' WHERE idOferta='".$_GET["idOferta"]."' ") or die (mysqli_error($link));	
	}

	header("Location: home.php");
?>