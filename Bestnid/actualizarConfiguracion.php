<?php
	include("sessionAdmin.php");
	include("conexion.php");

	if (!isset($_POST["porcentajeGanado"]) || !isset($_POST["duracionMaxima"]) || !isset($_POST["tiempoMaximo"]) ) {
		header("Location: configuracion.php");
	}
	$actualizarPorcentaje=mysqli_query($link, "UPDATE Configuracion SET valor='".$_POST["porcentajeGanado"]."' WHERE clave='porcentaje' ") or die (mysqli_error($link));
	$actualizarDuracionMaxima=mysqli_query($link, "UPDATE Configuracion SET valor='".$_POST["duracionMaxima"]."' WHERE clave='duracion_maxima' ")  or die (mysqli_error($link));
	$actualizarPorcentaje=mysqli_query($link, "UPDATE Configuracion SET valor='".$_POST["tiempoMaximo"]."' WHERE clave='tiempoLimiteElegirGanador'")  or die (mysqli_error($link));

	header ("Location: home.php");
?>
