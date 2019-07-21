<?php
class Permalinks
{
	private $site_path;
	
	public function __construct($site_path){
		#code ...
	}
	
	
	public function __toString(){
		return $this->site_path;
	}
	
	
	public static function site_path($site_path){
		self::removeSlash($site_path);
	}
	
	
	public static function removeSlash($x){
		if($x[strlen($x) - 1] == '/'):
			$x = rtrim($x, '/');
			return $x;
		endif;
	}
	
	public static function sanitize($x){
		$prohibited = array("'",'%22',':',',',':','%5B','%5D','(',')','%7B','%7D','=','%60','~','+','!','*');
		$x = str_ireplace($prohibited,'',$x);
		return @trim($x);
	}
	
	public static function segment($x){
		$u = str_replace(self::site_path($_SERVER['REQUEST_URI']), '' , $_SERVER['REQUEST_URI']);
		$u = explode('/', $u);
		if(isset($u[$x])){
			return self::sanitize($u[$x]);
		}else{
			return false;
		}
		return self::sanitize($u);
	}

}