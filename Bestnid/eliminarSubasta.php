<?php
	include("session.php");
	include("conexion.php");
	if (!isset($_GET["idSubasta"])) {
		header("Location:home.php");
	}
	$subastaNoCerrada = mysqli_query($link, "SELECT * FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' and estado <> 'cerrada' ") or die (mysqli_error($link));

	//chequear que la subasta este cerrada
	if (mysqli_num_rows($subastaNoCerrada)==0) {
		header("Location:home.php");
	}
	else {
		//chequear que el subastador sea el usuario logueado o quien ingrese a este sitio sea el administrador
		$tuplaSubasta=mysqli_fetch_array($subastaNoCerrada);
		if ($tuplaSubasta["idUsuario"]!=$_SESSION["idUsuario"] && $_SESSION["admin"]==false) {
			header("Location:home.php");
		}
		else {
			
			//eliminar comentarios de la subasta
			$eliminarComentarios=mysqli_query ($link, "DELETE FROM Comentario WHERE idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));

			//eliminar ofertas de la subasta
			$eliminarOfertas=mysqli_query ($link, "DELETE FROM Oferta WHERE idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));
			
			//eliminar la subasta
			$eliminarSubasta=mysqli_query ($link, "DELETE FROM Subasta WHERE idSubasta='".$_GET["idSubasta"]."' ") or die (mysqli_error($link));

			//eliminar producto de la subasta
			$eliminarProducto=mysqli_query ($link, "DELETE FROM Producto WHERE idProducto='".$tuplaSubasta["idProducto"]."' ") or die (mysqli_error($link));
	
			header ("Location: home.php");
		}
	}

?>