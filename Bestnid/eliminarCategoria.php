<?php
	include("sessionAdmin.php"); 
	include("conexion.php");
	
	$result = mysqli_query ($link, "DELETE FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");
	header("Location: listadoCategorias.php");
?>