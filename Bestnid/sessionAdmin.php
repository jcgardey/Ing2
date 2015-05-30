<?php
	session_start();
	if (!$_SESSION["autentificado"] || !$_SESSION["admin"]) {
		header ("Location: home.php");
	}

?>