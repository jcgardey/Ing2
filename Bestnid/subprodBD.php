<?php
	include("session.php"); //hay que tener una sesion iniciada
	include("conexion.php");

	$estado="activa";
	
	$result = mysqli_query ($link, "SELECT idCategoria FROM Categoria WHERE nombre='".$_GET["cate"]."' ");
	$rowCat=mysqli_fetch_array($result);
	
	$result = mysqli_query ($link, "INSERT INTO `bestnid`.`producto` (`nombre`,`descripcion`,`idCategoria`, `imagen`) VALUES ('".$_GET["nombre"]."',
	'".$_GET["desc"]."','".$rowCat["idCategoria"]."','".$_GET["imagen"]."') ");

	$result = mysqli_query ($link, "SELECT idProducto FROM Producto WHERE nombre='".$_GET["nombre"]."' and 
		descripcion='".$_GET["desc"]."' and idCategoria='".$rowCat["idCategoria"]."' and imagen='".$_GET["imagen"]."' ");
	
	$row=mysqli_fetch_array($result);
	
	$result = mysqli_query ($link, "INSERT INTO `bestnid`.`subasta` (`idUsuario`,`fecha_cierre`, `estado`, `idProducto`, `fecha_realizacion`) 
		VALUES ('".$_SESSION["idUsuario"]."', STR_TO_DATE('".$_GET["fecha"]."','%m/%d/%Y'), '".$estado."', '".$row["idProducto"]."', current_date() ) ");
	
	header("Location: home.php");
?>