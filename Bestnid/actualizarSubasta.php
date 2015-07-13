<?php
	include ("session.php");
	
	if($_FILES["imagen_fls"]["type"]!="image/jpeg" && $_FILES["imagen_fls"]["type"]!="image/png") {
		header("Location: editarSubasta.php?error=formato&idSubasta=".$_POST["idSubasta"]."");
	} 
	else {
			include ("conexion.php");
			//chequear que la subasta esté activa y que el usuario logueado sea el subastador
			$existeSubasta= mysqli_query($link, "SELECT * FROM Subasta WHERE idSubasta='".$_POST["idSubasta"]."' and idUsuario='".$_SESSION["idUsuario"]."' and estado='activa' ") or die (mysqli_error($link));
			if (mysqli_num_rows($existeSubasta)==0) {
				header ("Location:home.php");
			}
			else {
				$archivo = $_FILES["imagen_fls"]["tmp_name"];
				$destino = "Imagenes/".$_FILES["imagen_fls"]["name"];
				$nombre = $_POST["nombre"];
				$descripcion = $_POST["descripcion"];
				$categoria = $_POST["categoria"];
				$fecha=$_POST["fecha"];
				move_uploaded_file($archivo,$destino);
				
				//obtener el id del producto para actualizarle los datos
				$datosSubasta=mysqli_fetch_array($existeSubasta);

				//obtener el id de la categoria para actualizar el producto
				$resultadoCategoria= mysqli_query($link, "SELECT * FROM Categoria WHERE nombre='".$categoria."' ");
				$tuplaCategoria= mysqli_fetch_array($resultadoCategoria);

				$actualizarProducto=mysqli_query ($link, "UPDATE Producto SET nombre='".$nombre."', descripcion='".$descripcion."', imagen='".$destino."', idCategoria='".$tuplaCategoria["idCategoria"]."' WHERE idProducto='".$datosSubasta["idProducto"]."' ") or die (mysqli_error ($link));

				header ("Location: home.php");
			}
	}


?>