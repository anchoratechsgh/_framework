<?php

/*
*@name Cookie
*@desc this is a class to manage $_COOKIE variables
*@author Anchora Technologies
*/

final class Cookie
{

	private $name;
	private $value;

	public function __construct(){
		
	}
	

	public static function set($name, $value, $time=365, $domain=''){
		$secure = false;
		$httponly = false;
		if(empty($name) == false && empty($value) == false){
			@setcookie($name, $value, time()+60*60*24*$time, '/');
		}
	}#End

	

	public static function get($name){
		if(isset($_COOKIE[$name]) == true){
			return $_COOKIE[$name];
		}else{
			return false;
		}
	}#End

	

	public static function del($name){
		if(isset($_COOKIE[$name]) == true){
			setcookie($name,'', time()-3600, '/');
			unset($_COOKIE[$name]);
		}else{
			return false;
		}
	}#End	

}#Endclass