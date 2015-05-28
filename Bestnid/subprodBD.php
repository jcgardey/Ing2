<?php
	include("session.php"); //hay que tener una sesion iniciada
	include("conexion.php");
	$result = mysqli_query ($link, "INSERT INTO `bestnid`.`subasta` (`idUsuario`,`descripcion`,`fecha`,`estado`) 
		VALUES ('".$_SESSION["idUsuario"]."','".$_GET["desc"]."', ,'".$_GET["fecha"]."', 'activa') ");

	$result = mysqli_query ($link, "SELECT idSubasta FROM Subasta WHERE descripcion='".$_GET["desc"]."' ");
	$row=mysqli_fetch_array($result);

	$result = mysqli_query ($link, "SELECT idCategoria FROM Categoria WHERE nombre='".$_GET["cate"]."' ");
	$rowCat=mysqli_fetch_array($result);

	$result = mysqli_query ($link, "INSERT INTO `bestnid`.`producto` (`nombre`,`descripcion`,`idSubasta`,`idCategoria`, `imagen`)
		VALUES ('".$_GET["nombre"]."','".$_GET["desc"]."', ,'".$row["idSubasta"]."','".$rowCat["idCategoria"]."', '".$_GET["imagen"]."' 
			) ");
	//header("Location: home.php");
?>