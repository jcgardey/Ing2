<?php
	include("sessionAdmin.php"); 
	include("conexion.php");
	
	$result= mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='Otros' ");
	$row= mysqli_fetch_array($result);

	$result= mysqli_query ($link, "UPDATE Producto SET idCategoria='".$row["idCategoria"]."' WHERE idCategoria='".$_GET["id"]."' ");
	$result = mysqli_query ($link, "DELETE FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");
	header("Location: listadoCategorias.php");
?>