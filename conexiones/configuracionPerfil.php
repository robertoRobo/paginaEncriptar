<?php
	session_start();
	include('Enigma.class.php');
	if($_SESSION['session']){
		include('conexionBaseDatos.php');

		$unombre = $_POST['unombre'];
		$correo = Enigma::encrypt($_POST['email']);
		$nombre = Enigma::encrypt($_POST['nombre']);
		$telefono = Enigma::encrypt($_POST['tel']);
		$celular = Enigma::encrypt($_POST['cel']);
		$universidad = $_POST['universidad'];
		
		$foto = " ";
		if(isset($_FILES['fotoG'])){
			$foto = addslashes(file_get_contents($_FILES['fotoG']['tmp_name']));
		}
		//echo "nombre: ".$nombre.'<br>';
		/*
		echo 'usuarios '.$_POST['unombre'].'<br>';
		
		echo "correro: ".$_POST['email'].'<br>';

		
		echo "telefono: ".$_POST['tel'].'<br>';
		echo "celular: ".$_POST['cel'].'<br>';
		
		echo "uniiversidad: ".$_POST['universidad'].'<br>';
		echo "foto: ".$foto;*/
		$query='';

		//#$query = "call modificaPerfil ('$unombre','$nombre','$universidad','$correo','$foto','$telefono','$celular')";

		if ($foto == "") {
			$query = "UPDATE persona SET nombre_completo = '$nombre' , nombre_universidad = '$universidad' ,correo = '$correo',telefono = '$telefono' ,celular = '$celular' WHERE id_usuario = '$unombre'";
		}
		else{
			$query = "UPDATE persona SET nombre_completo = '$nombre' , nombre_universidad = '$universidad' ,correo = '$correo',telefono = '$telefono' ,celular = '$celular' ,imagen = '$foto' WHERE id_usuario = '$unombre'";
		}
		$conexion->query($query);
		mysqli_close($conexion);
		header("Status: 301 Moved Permanently");
		header("Location: http://192.168.0.107");
	}
?>
