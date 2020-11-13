<?php 
/**
* 
*/
class Response
{
	
	public static function randomString($length){
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$char = "";

		for ($i=0; $i < $length; $i++) { 
			$char.=$chars[rand(0, strlen($chars)-1)];
		}
		return $char;
	}
}