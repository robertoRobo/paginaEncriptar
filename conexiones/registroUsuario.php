<?php 
	include('conexionBaseDatos.php');
	include('Enigma.class.php');
	
	//
	if (!$conexion) {
    	//printf("Falló la conexión: %s\n", mysqli_connect_error());
    	exit();
	}
	mysqli_autocommit($conexion, TRUE);

	/*echo 'usuarios '.$_POST['unombre'].'<br>';
	
	echo "correro: ".$_POST['email'].'<br>';

	echo "nombre: ".$_POST['nombre'].'<br>';
	echo "telefono: ".$_POST['tel'].'<br>';
	echo "celular: ".$_POST['cel'].'<br>';
	
	echo "uniiversidad: ".$_POST['universidad'].'<br>';
	echo "pasword: ".$_POST['psw'].'<br>';
	echo "pasword2: ".$_POST['psw2'].'<br>';
*/
	$unombre =$_POST['unombre'];
	//$unombre1 = Enigma::encrypt($_POST['unombre']);
	//$des = Enigma::decrypt($unombre1);
	//echo $unombre.' '.$unombre1.' decrypt '.$des;
	
	$correo = Enigma::encrypt($_POST['email']);
	$nombre = Enigma::encrypt($_POST['nombre']);
	$telefono = Enigma::encrypt($_POST['tel']);
	$celular = Enigma::encrypt($_POST['cel']);
	$universidad = $_POST['universidad'];
	$pasword = Enigma::encrypt($_POST['psw']);
	$foto = " ";
	//echo $uname."__".Enigma::decrypt($correo)."__".Enigma::decrypt($nombre)."__".Enigma::decrypt($telefono);


	if(isset($_FILES['fotoG'])){
		$foto = addslashes(file_get_contents($_FILES['fotoG']['tmp_name']));
	}
	$query = "INSERT INTO persona (id_usuario,nombre_completo,nombre_universidad,correo,contrasena,telefono,celular,imagen) VALUES('$unombre','$nombre','$universidad','$correo','$pasword','$telefono','$celular','$foto')";
	//$query = "call registroUsuario ('$unombre','$nombre','$universidad','$correo','$pasword','$foto','$telefono','$celular') ";
	
	//$query = "INSERT INTO persona(id_usuario,nombre_completo,nombre_universidad,correo,contrasena,telefono,celular) VALUES ('rob','valdez','UAA','@ho','123','12333','449')";

	//echo $query;
	$estado = $conexion->query($query);
	//echo "rows affected ".$conexion->affected_rows."<br>";
	//echo $query."<br>";
	$list = $conexion->error_list;
	//print_r($list[0]['error']);
    mysqli_close($conexion);
	header("Status: 301 Moved Permanently");
	header("Location: http://localhost/segundacasa/segundaCasa.php");
?>
