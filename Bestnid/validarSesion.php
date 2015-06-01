<?php
	include("conexion.php");
	$result = mysqli_query ($link, " SELECT * FROM Usuario WHERE Usuario.nombre_usuario='".$_POST["input_user"]."' and 
		Usuario.password= '".$_POST["input_password"]."' ");
	if (mysqli_num_rows($result)==1) {
		session_start();
		$row=mysqli_fetch_array($result);
		$_SESSION ["autentificado"]=true;
		$_SESSION ["usuario"]= $_POST["input_user"];
		$_SESSION ["idUsuario"]=$row["idUsuario"];

		$result = mysqli_query ($link, " SELECT * FROM Configuracion WHERE clave='administrador' and 
		valor='".$_POST["input_user"]."' ");

		if (mysqli_num_rows($result)==1) {
			$_SESSION["admin"]=true;
		}
		else {
			$_SESSION["admin"]=false;	
		}
		header("Location: home.php");
	}
	else {
		header("Location: index.php?error=si");
	} 
?> 