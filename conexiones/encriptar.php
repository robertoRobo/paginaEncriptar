<?php
$key =  "claveSuperSecreta";
 function encrypt($string){
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5($key),
		$string,MCRYPT_MODE_CBC,md5(md5($key))),'\0');
}	

?>
