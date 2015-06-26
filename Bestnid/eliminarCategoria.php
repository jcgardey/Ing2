<?php
	include("sessionAdmin.php"); 
	include("conexion.php");
	
	//chequeo de parámetro
	if (!isset($_GET["id"]) ) {
		header("Location: listadoCategorias.php");
	}
	//chequeo que no se este eliminando una categoria que posee productos
	$existenProductos= mysqli_query ($link, "SELECT * FROM Categoria INNER JOIN Producto ON Categoria.idCategoria=Producto.idCategoria
	 WHERE Categoria.idCategoria='".$_GET["id"]."' ") or die (mysqli_error($link));
	
	if (mysqli_num_rows ($existenProductos)==0) {
		$borrarCategoria=mysqli_query($link, "DELETE FROM Categoria WHERE idCategoria='".$_GET["id"]."' ") or die (mysqli_error($link));	
	}

	header("Location: listadoCategorias.php");
?>