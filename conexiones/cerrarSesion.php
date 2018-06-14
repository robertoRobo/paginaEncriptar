<?php 
	session_start();
	if(isset($_SESSION['session'])){
		session_destroy();
	}
	header("Status: 301 Moved Permanently");
	header("Location: http://192.168.0.107/baseDatos/segundaCasa.php");
?>
