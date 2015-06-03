<?php
	include("sessionAdmin.php"); 
	include("conexion.php");
	
	//cheque de parámetro
	if (!isset($_GET["id"]) ) {
		header("Location: listadoCategorias.php");
	}

	//chequeo que no se este eliminando la categoria Otros
	$result= mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='Otros' and idCategoria='".$_GET["id"]."' ");
	if (mysqli_num_rows ($result)>0) {
		header("Location: listadoCategorias.php");
	}

	$result= mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='Otros' ");
	$row= mysqli_fetch_array($result);

	$result= mysqli_query ($link, "UPDATE Producto SET idCategoria='".$row["idCategoria"]."' WHERE idCategoria='".$_GET["id"]."' ");
	$result = mysqli_query ($link, "DELETE FROM Categoria WHERE idCategoria='".$_GET["id"]."' ");
	header("Location: listadoCategorias.php");
?>