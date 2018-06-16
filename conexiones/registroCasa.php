<?php 
	session_start();
	if (isset($_SESSION['session'])) {
		# code...
		include('conexionBaseDatos.php');
		$mensualidad = Enigma::encrypt($_POST['costo']);
		$direccion = Enigma::encrypt($_POST['inmueble']);
		$telefono = "";
		$gas = "";
		$wifi ="";
		$agua = "";
		$luz = "";
		$aseo = "";
		$mueble = "";
		$cable = "";
		$servicios = array();
		$posicion = 0;
		if (isset($_POST['wifi'])) {
			# code...
			$wifi = intval($_POST['wifi']);
			$servicios[$posicion] = $wifi;
			$posicion += 1;
		}
		if (isset($_POST['agua'])) {
			$agua = intval($_POST['agua']);
			$servicios[$posicion] = $agua;
			$posicion += 1;
		}
		if (isset($_POST['luz'])) {
			$luz = intval($_POST['luz']);
			$servicios[$posicion] = $luz;
			$posicion += 1;
		}
		if (isset($_POST['aseo'])) {
			$aseo = intval($_POST['aseo']);
			$servicios[$posicion] = $aseo;
			$posicion += 1;
		}
		if (isset($_POST['mueble'])) {
			$mueble = intval($_POST['mueble']);
			$servicios[$posicion] = $mueble;
			$posicion += 1;
		}
		if (isset($_POST['cable'])) {
			$cable = intval($_POST['cable']);
			$servicios[$posicion] = $cable;
			$posicion += 1;
		}
		if (isset($_POST['telefono'])) {
			$telefono = intval($_POST['telefono']);
			$servicios[$posicion] = $telefono;
			$posicion += 1;
		}
		if (isset($_POST['gas'])) {
			$gas = intval($_POST['gas']);
			$servicios[$posicion] = $gas;
			$posicion += 1;
		}
		$cuarto = Enigma::encrypt($_POST['cuarto']);
		$bano = Enigma::encrypt($_POST['bano']);
		$titulo= Enigma::encrypt($_POST['titulo']);

		$descripcion = Enigma::encrypt($_POST['descripcion']);
		$con = 0;
		$foto = "";
		$listaFotos = array();
		print_r($servicios);
		echo "<br>";
		if (isset($_FILES['imagenes'])) {
            $myFile = $_FILES['imagenes'];
            $fileCount = count($myFile["name"]);
            echo "imagenes: ".$fileCount."<br>";
            if($fileCount > 6){ //con este if nos validara que si el usuario ingresa mas de 6 imagenes solo guardara 6
            	$fileCount = 6;
            }
            for ($i = 0; $i < $fileCount; $i++) {
                    $con+=1;
                    echo "Name: ".$myFile["name"][$i]."<br>";
					echo "Type". $myFile["type"][$i]."<br>";
                    //     Name: <?= $myFile["name"][$i] <br>
                    //   Temporary file: <?= $myFile["tmp_name"][$i] <br>

                   	$listaFotos[$i] = addslashes(file_get_contents($myFile['tmp_name'][$i]));
                   	//$foto = addslashes(file_get_contents($myFile['tmp_name'][0]));
                    //    Type: <?=  <br>
                    //    Size: <?= $myFile["size"][$i] <br>
                     //   Error: <?= $myFile["error"][$i] <br>                      
            }
        }
        
        //echo "foto: ".$foto;
        $usuario = $_SESSION['session'];

        $query = "INSERT INTO inmueble(domicilio,costo_mensual,num_banos,num_habitaciones,descripcion,id_usuario,titulo) 
        
				VALUES('$direccion','$mensualidad','$bano','$cuarto','$descripcion','$usuario','$titulo')";
        
        $results = $conexion -> query($query);

       	$idCasa = "SELECT MAX(id_casa) as id_casa FROM inmueble WHERE id_usuario ='$usuario'"; 
       	
       	$contador = count($listaFotos);
       	for ($i=0; $i < $contador ; $i++) { 
       		# code...
       		$queryFoto = "INSERT INTO foto(id_casa,imagen) 
					    VALUES($idCasa,$listaFotos[$i])";
       			$results = $conexion -> query($queryFoto);
       	}
        

        echo "<br>".$query."<br>";
       	
       	$tamaño = count($servicios);
        echo "tamaño: ".$tamaño."<br>";
        #$results = $conexion -> query($idCasa);

        for ($i=0; $i < $tamaño; $i++) { 
        	# code...
        	$getIdInmueble = "INSERT INTO cuenta_con VALUES((SELECT MAX(id_casa)FROM  inmueble WHERE id_usuario='$usuario'),$servicios[$i])";
        	//echo "<br> ".$getIdInmueble."<br>";
        	$results = $conexion -> query($getIdInmueble);
        } 

        

        #$row = $results -> fetch_assoc();
       #echo "<br> id_casa: ".$row['id_casa']."<br>";

        #$rows_affected = intval($results->num_rows);
        #echo "columnas afectadas ".$rows_affected."<br>";
        //print_r($listaFotos);
        
        //echo ": ".$listaFotos[0];
        /*echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Usuario: ".$_SESSION['session'];
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "contador: ".$con."<br>";
		echo "titulo: ".$titulo."<br>";
		echo "costo: ".$mensualidad."<br>";
		echo "direccion: ".$direccion."<br>";
		echo "wifi: ".$wifi."<br>";
		echo "agua: ".$agua."<br>";
		echo "luz: ".$luz."<br>";
		echo "aseo: ".$aseo."<br>";
		echo "bano: ".$bano."<br>";
		echo "muebles: ".$mueble."<br>";
		echo "habitaciones: ".$cuarto."<br>";
		echo "cable: ".$cable."<br>";
		echo "descripcion: ".$descripcion."<br>";
		echo "telefono: ".$telefono."<br>";
		echo "gas: ".$gas."<br>";*/
		mysqli_close($conexion);
	}
	header("Status: 301 Moved Permanently");
	header("Location: http://localhost/baseDatos/segundaCasa.php");
?>