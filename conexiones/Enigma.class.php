<?php
//Comentario de prueba
class Enigma{
	private static $key =  "";
	public static function encrypt($string){
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5(Enigma::$key),
		$string,MCRYPT_MODE_CBC,md5(md5(Enigma::$key))));
	}	
	public static function decrypt($string){
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5(Enigma::$key),
		base64_decode($string),MCRYPT_MODE_CBC,md5(md5(Enigma::$key))));
	}
}
?>
