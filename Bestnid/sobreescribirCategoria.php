<?php
	include("conexion.php");
	include("sessionAdmin.php");
	$result = mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='".$_POST["nombreCategoria"]."' and 
	idCategoria!='".$_POST["id"]."' ");
	$num = mysqli_num_rows($result);
	if ($num  != 0) { 
			header("Location: editarCategoria.php?error=si&nombreCategoria=".$_POST["nombreCategoria"]."&descripcion=".$_POST["descripcionCategoria"]."&id=".$_POST["id"]." ");
	}
	else {
		$result = mysqli_query ($link, "UPDATE Categoria SET nombre='".$_POST["nombreCategoria"]."', 
			descripcion='".$_POST["descripcionCategoria"]."' WHERE idCategoria='".$_POST["id"]."' ");	
		header("Location: listadoCategorias.php");
	}
?>