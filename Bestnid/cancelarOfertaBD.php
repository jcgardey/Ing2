<?php 
	include("session.php"); 

	if (!isset($_GET["idOferta"]) ) {
		header ("Location: home.php");
	}

	include("conexion.php");
	$existeOferta = mysqli_query($link,"SELECT * FROM Oferta INNER JOIN Subasta ON Oferta.idSubasta=Subasta.idSubasta WHERE Oferta.idOferta='".$_GET["idOferta"]."'  
		and Oferta.idUsuario='".$_SESSION["idUsuario"]."' and Subasta.estado <> 'cerrada' ") or die (mysqli_error($link));

	
	//la oferta solo puede ser eliminada si el usuario logueado es el dueño de la oferta
	if (mysqli_num_rows($existeOferta)== 1) {
		mysqli_query($link,"DELETE FROM Oferta WHERE idOferta='".$_GET["idOferta"]."' ") or die (mysqli_error($link));	
	}
	header("Location: home.php");
?>