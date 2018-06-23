<?php 
	session_start();
	if(isset($_SESSION['session'])){
		session_destroy();
	}
	header("Status: 301 Moved Permanently");
	header("Location: https://192.168.0.107");
?>
