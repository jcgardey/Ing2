<?php
	include("conexion.php");
	$result = mysqli_query ($link, "SELECT * FROM Categoria WHERE nombre='".$_POST["nombreCategoria"]."' ");
	$num = mysqli_num_rows($result);
	if ($num  != 0) { 
			header("Location: altaCategoria.php?error=si");
	}
	else {
		$result = mysqli_query ($link, "INSERT INTO `bestnid`.`categoria` (`nombre`,`descripcion`) VALUES
		('".$_POST["nombreCategoria"]."','".$_POST["descripcionCategoria"]."') " ); 	
		header("Location: listadoCategorias.php");
	}
?> 