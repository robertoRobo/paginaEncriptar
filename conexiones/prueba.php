<?php 
	$conexion = new mysqli("192.168.56.101","root","seguridad2018","proyecto");

	$query = "INSERT INTO hola(id,hola,jaja,que) VALUES (1,'HOLA','JAJA',2) ";
	$conexion -> query($query);
?>
