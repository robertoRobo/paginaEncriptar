<?php 
	//
	session_start();
	include('Enigma.class.php');

	
	if(isset($_SESSION['session'])){
		echo "ya existe la sesion";
		session_destroy();
	}else{

		//$conexion = new mysqli('192.168.56.101','root','roberto123','proyecto');
		include('conexionBaseDatos.php');

	 	$usuario = $_POST['uname'];
	 	$password = Enigma::encrypt($_POST['psw']);

		$query = "SELECT id_usuario,contrasena FROM persona WHERE id_usuario = '$usuario' AND contrasena = '$password'";
	 	//#$query = "CALL usuarios('$usuario','$password')";
	 	$results = $conexion -> query($query);
	 
	 	$rows_affected = intval($results->num_rows);
	 	$exito = "no";
	 	if($rows_affected != 0){
			//echo "userL: ".$usuario." pswL: ".$password." <br>";
			$row = $results->fetch_assoc();

			$usuario2 = $row['id_usuario'];
			$password2  = Enigma::decrypt($row['contrasena']);
			if($usuario == $usuario2 && Enigma::decrypt($password) == $password2){
		 		$_SESSION['session'] = $usuario;
				echo "user: ".$usuario." pwd:".$password."<br>";
				$exito = "si";
		 	}else{
		 		echo "-1";
		 	}
	 	}else{
	 		echo $rows_affected;
	 	}
	 	mysqli_close($conexion);	
 	}
 	
 	header("Status: 301 Moved Permanently");
	header("Location: https://192.168.0.107");

?>
