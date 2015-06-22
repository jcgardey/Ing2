<?php 
			
			include ("conexion.php");
			include ("session.php");
			//chequear que el usuario logueado es quien realmente hizo la subasta que la subasta haya finalizado o este cerrada
			$result=mysqli_query($link, " SELECT * FROM Subasta INNER JOIN Oferta ON Oferta.idSubasta=Subasta.idSubasta 
				WHERE idOferta='".$_GET["idOferta"]."' and Subasta.idSubasta='".$_GET["idSubasta"]."' and Subasta.idUsuario='".$_SESSION["idUsuario"]."' and estado='finalizada' " );
			
			$rowSubasta=mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result)==0 || !isset($_GET["idOferta"]) || !isset($_GET["idSubasta"]) ) 
				header("Location:home.php");


			$result = mysqli_query ($link, "SELECT valor FROM Configuracion WHERE clave='porcentaje'");

			echo mysqli_num_rows($result);
							
			$rowConf = mysqli_fetch_array($result);
							
			
			$result = mysqli_query ($link, "INSERT INTO `bestnid`.`venta`(`fecha`,`porcentaje`,`idOferta`)
				VALUES (current_date(),CONVERT('".$rowConf["valor"]."',unsigned), '".$_GET["idOferta"]."' )");
				
			//cambiar el estado de la subasta
			$result= mysqli_query ($link, "UPDATE Subasta SET estado='cerrada' WHERE estado='finalizada' and idSubasta='".$_GET["idSubasta"]."' ");


			header ("Location: visualizarGanador.php?idOferta=".$_GET["idOferta"]."&idSubasta=".$_GET["idSubasta"]."  ");
?>