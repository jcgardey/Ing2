<?php
	include("conexion.php");
	$result = mysqli_query ($link, " SELECT * FROM Usuario WHERE Usuario.nombre_usuario='".$_POST["input_user"]."' and 
		Usuario.password= '".$_POST["input_password"]."' ");
	if (mysqli_num_rows($result)==1) {
		session_start();
		$_SESSION ["autentificado"]=true;
		$_SESSION ["usuario"]= $_POST["input_user"];
		header("Location: home.php");
	}
	else {
		header("Location: index.php?error=si");
	} 
?> 