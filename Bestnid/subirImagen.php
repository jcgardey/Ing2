<?php

if($_POST["nombre"]==""){
		header("Location: altaProducto.php?error=nombre");
	}else{
		if($_POST["descripcion"]==""){
			header("Location: altaProducto.php?error=descripcion&nombre=".$_POST["nombre"]);
		}else{
			if($_POST["fecha"]==""){
				header("Location: altaProducto.php?error=fecha&nombre=".$_POST["nombre"]."&descripcion=".$_POST["descripcion"]);
			}else{
					if($_FILES["imagen_fls"]["type"]!="image/jpeg"&&$_FILES["imagen_fls"]["type"]!="image/png"){
						header("Location: altaProducto.php?error=formato&nombre=".$_POST["nombre"]."&descripcion=".$_POST["descripcion"]);
					}else{
						
						$archivo = $_FILES["imagen_fls"]["tmp_name"];
						$destino = "Imagenes/".$_FILES["imagen_fls"]["name"];
						$nombre = $_POST["nombre"];
						$descripcion = $_POST["descripcion"];
						$categoria = $_POST["categoria"];
						$fecha=$_POST["fecha"];
						move_uploaded_file($archivo,$destino);
						header("Location: verProducto.php?imagen=".$destino."&nombre=".$nombre."&desc=".$descripcion."&cate=".$categoria."&fecha=".$fecha);
					}
				}
			}
		}
?>