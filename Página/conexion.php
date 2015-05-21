<?php
	$link = mysqli_connect('localhost', 'root','juan123cruz1234', 'Bestnid') or die ("Error " . mysqli_error($link));

	if (!mysqli_select_db($link,"Bestnid") ) {
		echo "Error al seleccionar la base de datos";
	}
?>