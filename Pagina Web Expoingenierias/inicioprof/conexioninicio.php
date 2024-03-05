<?php
	$dbhost = "localhost";
	$dbuser = "TC2005B_401_3";
	$dbpass = "4#_aWRLFo!5=Te6P";
	$dbname = "TC2005B_401_3";

	$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$conexion) 
	{
		die("No hay conexión: ".mysqli_connect_error());
	}

?>
