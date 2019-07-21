<?php
final class Exportto
{
	private static $name;
	private static $body;
	
	public static function word($name,$body){
		header('Content-Type: application/vnd.msword');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('content-disposition: attachment;filename='.$name.'.doc');
		echo '<html>';
		echo $body;
		echo '</html>';	
	}#end
		
}