<?php $session = new Session();

/*
*@name Session
*@desc this is a class to manage $_SESSION variables
*@author Anchora Technologies
*/

class Session
{

	private $name;
	private $value;

	public function __construct(){
		@session_name('anchora_technologies');
		@session_start();
	}#End
	

	public static function set($name, $value){
		if(empty($name) == false && empty($value) == false){
			$_SESSION[$name] = $value;
		}
	}#End

	

	public static function get($name, $name2='', $name3=''){
		if(isset($_SESSION[$name])){
			if(empty($name2) == false){
				return $_SESSION[$name][$name2];
			}else
			if(empty($name3) == false){
				return $_SESSION[$name][$name2][$name3];
			}else{
				return $_SESSION[$name];
			}
		}else{
			return false;
		}
	}#End

	

	public static function del($name){
		if(isset($_SESSION[$name]) == true){
			unset($_SESSION[$name]);
		}else{
			return false;
		}
	}#End
	

	public static function getSessionID(){
		return session_id();
	}#End



	public static function destroy(){
		$_SESSION = array();
		session_destroy();
	}#End


	public static function auth(){

	}
	

}#End Class